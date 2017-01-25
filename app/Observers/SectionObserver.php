<?php

namespace App\Observers;

use App\Section;

class SectionObserver
{
    /**
     * Listen to the Person saved event.
     *
     * @param  Section $person
     *
     * @return void
     */
    public function saved(Section $section)
    {
        session(['section' => Section::find(session('section')->id)->load('virtual_number')]);

        if (session('user')->scope !== 'section') {
            session(['sections' => Section::all()]);
        }
    }
}