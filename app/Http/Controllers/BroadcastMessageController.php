<?php

namespace App\Http\Controllers;

use App\VirtualNumber;
use App\Person;
use App\BroadcastMessage;
use App\BroadcastList;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Requests;
use SMS;
use Nexmo;
use App\Jobs\SendSMS;
use Uuid;

class BroadcastMessageController extends Controller
{
    public function index()
    {
        $broadcast_messages = BroadcastMessage::with('broadcast_list')->get();
        return view('broadcast_message.index', compact('broadcast_messages'));
    }

    public function create()
    {
        return view('broadcast_message.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:broadcast_messages|max:255',
            'body' => 'required',
            'broadcast_list_id' => 'numeric',
        ]);

        $broadcast_message = new BroadcastMessage;
        $broadcast_message->title = $request->title;
        $broadcast_message->body = $request->body;
        $broadcast_message->type = 'outgoing';
        $broadcast_message->broadcast_list_id = $request->broadcast_list_id;
        $broadcast_message->save();

        session()->flash('flash_broadcast_message', 'broadcast_message créé');
        session()->flash('flash_broadcast_message_type', 'success');

        return redirect()->route('broadcast_message.show', [$broadcast_message]);
    }

    public function show(BroadcastMessage $broadcast_message)
    {
        $broadcast_lists = BroadcastList::all();
        $people = Person::All();
        $messages = $broadcast_message->messages()->with('recipientable')->get();;
        return view('broadcast_message.show', compact('broadcast_message', 'broadcast_lists', 'people', 'messages'));
    }

    public function edit(BroadcastMessage $broadcast_message)
    {
        $broadcast_message->load('broadcast_list');
        return view('broadcast_message.edit', compact('broadcast_message'));
    }

    public function update(Request $request, BroadcastMessage $broadcast_message)
    {
        $broadcast_message->update($request->all());

        session()->flash('flash_broadcast_message', 'Message modifié');
        session()->flash('flash_broadcast_message_type', 'success');

        return redirect()->route('broadcast_message.show', [$broadcast_message]);
    }

    public function destroy(Request $request, BroadcastMessage $broadcast_message)
    {
        $broadcast_message->delete();

        session()->flash('flash_broadcast_message', 'Message supprimé');
        session()->flash('flash_broadcast_message_type', 'success');

        if($request->deletion_origin === 'broadcast_list') {
            return redirect()->route('broadcast_list.show', [$broadcast_message->broadcast_list()] );
        }

        return redirect()->route('broadcast_message.index');
    }

    public function send(Request $request, BroadcastMessage $broadcast_message)
    {
        $recipients_ids = [];
        if ($request['people_ids']) {
            $recipients_ids = array_flatten($request['people_ids']);
        }
        if ($request['broadcast_lists_ids']) {
            $broadcast_lists_ids = array_flatten($request['broadcast_lists_ids']);
            $broadcast_lists = BroadcastList::find($broadcast_lists_ids);
            $broadcast_lists->load('list_subscribers');
            foreach ($broadcast_lists as $broadcast_list) {
                foreach ($broadcast_list->list_subscribers as $list_subscriber) {
                    $recipients_ids[] = $list_subscriber->person_id;
                }
            }
        }
        $recipients_ids = array_unique($recipients_ids);
        $recipients = Person::find($recipients_ids)->where('mobile_phone_status', 'valid');
        $sender = VirtualNumber::find(1);
        foreach ($recipients as $recipient) {
            $message = new Message;
            $message->status = 'pending';
            $message->contact_id = $recipient->id;
            $message->broadcast_message_id = $broadcast_message->id;
            $sender->messages_sent()->save($message);
            $recipient->messages_received()->save($message);
            dispatch((new SendSMS($broadcast_message, $message))->onQueue('2-way-sms-' . '1'));
        }
        $broadcast_message->sent = true;
        $broadcast_message->save();

        session()->flash('flash_broadcast_message', 'Message envoyé');
        session()->flash('flash_broadcast_message_type', 'success');

        return redirect()->route('broadcast_message.show', [$broadcast_message]);
    }
}
