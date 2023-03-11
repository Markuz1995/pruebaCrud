<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAdminNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->adminEmail = env('ADMIN_EMAIL');
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreated  $event)
    {
        $user = $event->user;
        $adminEmail = $this->adminEmail;
        $subject = 'Nuevo Usuario';
        $data = [
            'user' => $user,
        ];
        Mail::to($adminEmail, $adminName)->send(new AdminEmail($subject, $data));
    }
}
