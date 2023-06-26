<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Enums\Status;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $passwordConfirmation = '';
    public $phone;
    public $city; // Set the default city to 'Casablanca'
    public $country; // Set

    public function mount()
    {
        $this->city = 'Casablanca';
        $this->country = 'Morocco';
    }

    public function register()
    {
        $this->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|numeric',
            'password' => 'required|min:8|same:passwordConfirmation',
        ]);

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'phone'    => $this->phone,
            'city'     => $this->city,
            'country'  => $this->country,
            'status'   => Status::INACTIVE, // Set status to inactive by default
        ]);

        $role = Role::where('name', 'client')->first();

        $user->assignRole($role);

        event(new Registered($user));

        Auth::login($user, true);

        switch (true) {
            case $user->hasRole('admin'):
                $homePage = RouteServiceProvider::ADMIN_HOME;

                break;
            default:
                $homePage = RouteServiceProvider::CLIENT_HOME;

                break;
        }

        return redirect()->intended($homePage);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
