<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;
use App\Notifications\DataChangeNotification;
use Notification;

class UserObserver
{
    public function created(User $user): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($user), $user->id),
            'reason' => auth()->user(),
        ];

        $admins = User::isAdmin();

        Notification::send($admins, new DataChangeNotification($payload));
    }
}
