<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class AssignRoleToUserListener
{
    public function handle(Registered $event): void
    {
        $event->user->assignRole('client');
    }
}
