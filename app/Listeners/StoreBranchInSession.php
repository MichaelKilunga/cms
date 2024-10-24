<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Session;

class StoreBranchInSession
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        // Store the branch_id in the session after the user logs in
        $user = $event->user;

        // Assuming the user has a `branch_id` field
        if ($user->branch_id) {
            Session::put('branch_id', $user->branch_id);
        }
    }
}
