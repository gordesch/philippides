<?php

namespace App\Jobs;

use App\Person;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


class CheckMobilePhone implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $person;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $api = 'https://api.nexmo.com/ni/advanced/json?' . http_build_query([
            'api_key'    => env('NEXMO_KEY'),
            'api_secret' => env('NEXMO_SECRET'),
            'number'     => $this->person->mobile_phone,
            'country'    => 'FR'
        ]);
        $ch = curl_init($api);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $raw_response = curl_exec($ch);
        $response = json_decode($raw_response, true);
        if ($response['status'] == 0)
        {
            $this->person->mobile_phone = $response['international_format_number'];
            $this->person->mobile_phone_status = $response['valid_number'];
        } else {
            $this->person->mobile_phone_status = 'unknown';
        }
        $this->person->mobile_phone_checked_at = Carbon::now();
        $this->person->save();
    }
}
