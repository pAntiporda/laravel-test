<?php

namespace App\Http\Controllers;

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
            $newsletter->subscribe(request('email'));
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
