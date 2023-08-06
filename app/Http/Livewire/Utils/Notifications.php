<?php

declare(strict_types=1);

namespace App\Http\Livewire\Utils;

use Carbon\Carbon;
use Livewire\Component;

final class Notifications extends Component
{
    public $notifications;

    public function render()
    {
        return view('livewire.notifications');
    }

    public function mount(): void
    {
        $this->notifications = auth()->user()->notifications->take(10);
    }

    public function toggleReadStatus($key): void
    {
        $notification = $this->notifications[$key];

        null === $notification->read_at ? $notification->read_at = Carbon::now()->toTimeString() : $notification->read_at = null;
        $notification->save();
    }
}
