<?php

namespace App\Providers;

use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Newsletter::class, function () {
            // From the course, this would instantiate the client with help from Mailchimp SDK but for the sake
            // of this project, would just reference the placeholder config value of mailchimp

            // So everytime and everywhere in the app the Newsletter is referenced as a dependency, it would map to this function
            // which in turn returns the instance of the MailchimpNewsletter class making switching services in the future easier.
            return new MailchimpNewsletter(config('services.mailchimp.apiKey'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
