@extends('layouts.dashboard')
@section('title', __('Create team'))
@section('content')
<div class="card bg-white dark:bg-dark-eval-1">
    <div class="p-6 rounded-t rounded-r mb-0 border-b border-slate-200">
        <div class="card-header-container flex flex-wrap">
            <h6 class="text-xl font-bold text-zinc-700 dark:text-zinc-300">
                {{ __('Create team') }}
            </h6>
        </div>
    </div>
    <div class="p-4">
        @livewire('admin.team.create')
    </div>
</div>
@endsection