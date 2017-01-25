<?php

namespace App\Observers;

use App\Person;
use App\Jobs\CheckMobilePhone;

class PersonObserver
{
    /**
     * Listen to the Person saved event.
     *
     * @param  Person $person
     * @return void
     */
    public function saved(Person $person)
    {
        if ($person->mobile_phone_status === 'checking') {
            dispatch((new CheckMobilePhone($person)));
        }
    }
}