<?php

namespace App\Http\Controllers;

use App\Events\SubscribedToOtherMarketing;
use App\Services\Newsletter;
use Exception;

class NewsletterController extends Controller
{
    // if there's only one method in a controller, you could just use the __invoke method to map it to that action
    // when the controller is called. This would also mean you could just omit the actions after the usage of this class
    // as seen in the api.php routes file ie. Route::post('/newsletter', NewsletterController::class);
    public function __invoke(Newsletter $newsletter)
    {
        request()->validate(['email' => ['required', 'email']]);
        try {
            $email = request('email');
            // Newsletter in this instance is just an interface and was instantiated in the AppService Provider to
            // figure out which class (that implements the Newsletter interface) to use
            $newsletter->subscribe($email);

            // Send an event (event sends the email of the user to be signed up to other marketing platforms)
            // Any arguments passed to the dispatch method would be passed to the constructor of the Event class (SubscribedToOtherMarketing)
            SubscribedToOtherMarketing::dispatch($email);

            return [
                'type' => 'success',
                'message' => 'Subscribed.'
            ];
        } catch (Exception $e) {
            return [
                'type' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }
}
