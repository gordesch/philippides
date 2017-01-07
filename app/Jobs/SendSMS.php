<?php

namespace App\Jobs;

use Nexmo;
use App\BroadcastMessage;
use App\Message;
use App\Person;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSMS implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $broadcast_message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(BroadcastMessage $broadcast_message, Message $message)
    {
        $this->message = $message;
        $this->broadcast_message = $broadcast_message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $start_at = microtime();
        $recipient = Person::find($this->message->recipient_id);
        $response = Nexmo::message()->send([
            'to' => $recipient->mobile_phone,
            'from' => env('SMS_FROM'),
            'text' => $this->broadcast_message->body
        ]);
        $this->message->provider_internal_id = $response->getMessageId();
        $this->message->cost = $response->getPrice();
        if($response->getStatus() == 0){
            $this->message->status = 'sent';
        } else {
            $this->message->status = 'error';
        }
        $this->message->save();
        $end_at = microtime();
        $elapsed_time = $end_at - $start_at;
        if ($elapsed_time < 1){
            sleep(2 - $elapsed_time);
        }
    }
}
