<?php

namespace App\Services;

class MailchimpNewsletter implements Newsletter
{
    // From the course it was actually the imported package from Mailchimp SDK with the proper type of ApiClient
    // but for  the sake of this project will use a string instead
    public function __construct(protected string $client)
    {
        //
    }

    public function subscribe(string $email, ?string $listId = null)
    {
        // MailchimpNewsletter implementattion to subsribe the $email to appropriate listId
        return 'okay';
    }
}
