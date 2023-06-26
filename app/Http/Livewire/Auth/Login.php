<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;

class Login extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember_me = false;

    protected array $rules = [
        'email'    => 'required|email',
        'password' => 'required',
    ];

    public function authenticate()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            $user = User::where(['email' => $this->email])->first();

            auth()->login($user, $this->remember_me);

            switch (true) {
                case $user->hasRole('admin'):
                    $homePage = RouteServiceProvider::ADMIN_HOME;

                    break;
                default:
                    $homePage = RouteServiceProvider::CLIENT_HOME;

                    break;
            }

            return redirect()->intended($homePage);
        } else {
            $this->addError('email', __('These credentials do not match our records'));
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
