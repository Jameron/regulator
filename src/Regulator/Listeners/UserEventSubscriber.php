<?php

namespace Jameron\Regulator\Listeners;

use Log;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event) {
        Log::info('User logged in.');
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) {
        Log::info('User logged out.');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'Jameron\Regulator\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'Jameron\Regulator\Listeners\UserEventSubscriber@onUserLogout'
        );
    }

}
