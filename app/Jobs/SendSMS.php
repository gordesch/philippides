<?php

namespace App\Jobs;

use Nexmo;
use App\Sending;
use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSMS implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $sending;

    /**
     * Create a new job instance.
     *
     * @param  Sending $sending
     * @param  Message $message
     *
     */
    public function __construct(Sending $sending, Message $message)
    {
        $this->message = $message;
        $this->sending = $sending;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $start_at = microtime();
        $response = Nexmo::message()->send([
            'to' => $this->message->recipientable->mobile_phone,
            'from' => $this->message->senderable->section->virtual_number->number,
            'text' => $this->sending->body,
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
        if ($elapsed_time < 2){
            sleep(2 - $elapsed_time); // Nexmo Virtual Number SMS API Throttle Rate: 1 per 2 seconds
        }
    }
}
