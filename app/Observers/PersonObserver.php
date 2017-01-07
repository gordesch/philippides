<?php

namespace App\Observers;

use App\Person;
use App\Jobs\CheckMobilePhone;

class PersonObserver
{
    /**
     * Listen to the Person saving event.
     *
     * @param  Person  $person
     * @return void
     */
    public function saving(Person $person)
    {
        if (array_has($person->getDirty(), ['mobile_phone']))
        {
            $person->mobile_phone_status = 'checking';
            dispatch((new CheckMobilePhone($person))->onQueue('checks'));
        }
    }
}