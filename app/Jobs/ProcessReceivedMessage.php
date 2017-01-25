<?php

namespace App\Jobs;

use App\User;
use SMS;
use App\Message;
use App\Person;
use App\Sending;
use Notification;
use App\Notifications\MessageReceived;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessReceivedMessage implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $incoming;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($incoming)
    {
        $this->incoming = $incoming;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sender = Person::where('mobile_phone', $this->incoming->from())->get()->first();
        if (!$sender) {
            $body = '** Message automatique ** Vous ne pouvez pas envoyer de message à ce numéro.';
            SMS::send($body, null, function ($sms) {
                $sms->to($this->incoming->from());
            });
        }
        $recipient = $sender->section;

        $sending = new Sending;
        $sending->body = $this->incoming->message();
        $sending->type = 'incoming';
        $sending->section_id = $sender->section_id;
        $sending->save();

        $message = new Message;
        $message->type = 'incoming';
        $message->status = 'incoming';
        $message->contact_id = $sender->id;
        $sender->messages_sent()->save($message);
        $recipient->messages_received()->save($message);
        $message->provider_internal_id = $this->incoming->id();
        $message->sending_id = $sending->id;
        $message->section_id = $sender->section_id;
        $message->save();

        $users = User::withoutGlobalScopes()->where('section_id',
            $recipient->id)->whereNotNull('telegram_user_id')->get()->first();
        Notification::send($users, new MessageReceived($message));
    }
}