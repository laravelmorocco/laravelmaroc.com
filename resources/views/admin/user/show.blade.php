@extends('layouts.dashboard')
@section('title', __('Show - ') . $user->name)
@section('content')
    <div class="card bg-white dark:bg-dark-eval-1">
        <div class="p-6 rounded-t rounded-r mb-0 border-b border-slate-200">
            <div class="card-header-container flex flex-wrap">
                <h6 class="text-xl font-bold text-zinc-700 dark:text-zinc-300">
                    {{ __('User') }} :
                    {{ $user->name }}
                </h6>
                <div class="float-right">
                    <a href="{{ route('admin.users.edit', $user) }}"
                        class="md:text-sm sm:text-xs bg-blue-900 text-white hover:text-blue-800 hover:bg-blue-100 active:bg-blue-200 focus:ring-blue-300 text-sm font-bold uppercase px-6 py-2 rounded-md shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150">
                        {{ __('Edit') }}
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        class="leading-4 md:text-sm sm:text-xs bg-gray-400 text-black hover:text-blue-800 hover:bg-gray-100 active:bg-blue-200 focus:ring-blue-300 font-medium uppercase px-6 py-2 rounded-md shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                        {{ __('Go back') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="p-4">
            <div class="">
                <table class=" table table-auto table-view w-full">
                    <tbody>
                        <tr>
                            <th>
                                {{ __('Name') }}
                            </th>
                            <td>
                                {{ $user->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('Email') }}
                            </th>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $user->email }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $user->email }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('Phone') }}
                            </th>
                            <td>
                                {{ $user->phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('Company name') }}
                            </th>
                            <td>
                                {{ $user->company_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('Telegram Link') }}
                            </th>
                            <td>
                                {{ $user->telegram_link }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('Whatsapp number') }}
                            </th>
                            <td>
                                {{ $user->whatsapp_number }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('Address') }}
                            </th>
                            <td>
                                {{ $user->address }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('Roles') }}
                            </th>
                            <td>
                                @foreach ($user->roles as $key => $entry)
                                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded last:mr-0 mr-1 text-indigo-600 bg-indigo-200">{{ $entry->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
