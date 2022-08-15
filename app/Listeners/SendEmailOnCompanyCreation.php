<?php

namespace App\Listeners;


use App\Events\CompanyCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailOnCompanyCreation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.ß
     *
     * @param  \App\Events\CompanyCreated  $event
     * @return void
     */
    public function handle(CompanyCreated $event)
    {
        Log::debug('SendEmailOnCompanyCreation Listener Triggered.');

        $company = $event->company;
        Mail::to($company->email)->send(new \App\Mail\CompanyCreated($company));
    }
}
