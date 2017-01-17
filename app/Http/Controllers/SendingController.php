<?php

namespace App\Http\Controllers;

use App\BroadcastList;
use App\Person;
use App\Message;
use App\Sending;
use Illuminate\Http\Request;
use App\Jobs\SendSMS;

class SendingController extends Controller
{
    public function index()
    {
        $sendings = Sending::all();
        return view('sending.index', compact('sendings'));
    }

    public function create()
    {
        return view('sending.create', [
            'sending' => new Sending
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $sending = new Sending;
        $sending->title = $request->title;
        $sending->body = $request->body;
        $sending->type = 'outgoing';
        $sending->section_id = session('section')->id;
        $sending->save();

        session()->flash('flash_message', 'Envoi créé');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('sending.show', [$sending]);
    }

    public function show(Sending $sending)
    {
        $broadcast_lists = BroadcastList::all();
        $people = Person::all()->where('mobile_phone_status', 'valid');
        $messages = $sending->messages();
        return view('sending.show', compact('sending', 'broadcast_lists', 'people', 'messages'));
    }

    public function edit(Sending $sending)
    {
        $sending->messages();
        return view('sending.edit', compact('sending'));
    }

    public function update(Request $request, Sending $sending)
    {
        $sending->update($request->all());

        session()->flash('flash_message', 'Envoi modifié');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('sending.show', [$sending]);
    }

    public function destroy(Sending $sending)
    {
        $sending->delete();

        session()->flash('flash_message', 'Envoi supprimé');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('sending.index');
    }

    public function send(Request $request, Sending $sending)
    {
        $sender = session('user');
        $sender_number = session('section')->virtual_number->number;
        $recipients = $this->find_individual_recipients($request);
        foreach ($recipients as $recipient) {
            $message = new Message;
            $message->status = 'pending';
            $message->contact_id = $recipient->id;
            $message->sending_id = $sending->id;
            $message->section_id = session('section')->id;
            $sender->messages_sent()->save($message);
            $recipient->messages_received()->save($message);
            dispatch((new SendSMS($sending, $message)));
        }
        $sending->sent = true;
        $sending->save();

        session()->flash('flash_message', 'Envoi envoyé');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('sending.show', [$sending]);
    }

    private function find_individual_recipients(Request $request)
    {
        $recipients_ids = [];
        if ($request['person_ids']) {
            $recipients_ids = array_flatten($request['person_ids']);
        }
        if ($request['broadcast_list_ids']) {
            $broadcast_list_ids = array_flatten($request['broadcast_list_ids']);
            $broadcast_lists = BroadcastList::find($broadcast_list_ids);
            $broadcast_lists->load('list_subscribers');
            foreach ($broadcast_lists as $broadcast_list) {
                foreach ($broadcast_list->list_subscribers as $list_subscriber) {
                    $recipients_ids[] = $list_subscriber->person_id;
                }
            }
        }
        $recipients_ids = array_unique($recipients_ids);
        $recipients = Person::find($recipients_ids)->where('mobile_phone_status', 'valid');
        return $recipients;
    }
}
