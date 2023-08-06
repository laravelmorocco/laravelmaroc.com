@extends('layouts.dashboard')
@section('title', __('Profile - ') . ($user->name))
@section('content')

    <div class="card bg-white dark:bg-dark-eval-1">
        <div class="p-6 rounded-t rounded-r mb-0 border-b border-slate-200">
            <div class="card-header-container flex flex-wrap">
                <h6 class="text-xl font-bold text-zinc-700 dark:text-zinc-300">
                    {{ $user->name }}
                </h6>
            </div>
        </div>

        <div class="p-4">
            @livewire('admin.user.profile')
        </div>
    </div>
@endsection
