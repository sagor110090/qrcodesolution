<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{state, rules};

middleware(['guest']);
state(['name' => '', 'email' => '', 'password' => '', 'passwordConfirmation' => '']);
rules(['name' => 'required', 'email' => 'required|email|unique:users', 'password' => 'required|min:8|same:passwordConfirmation']);
name('register');

$register = function () {
    $this->validate();

    $user = User::create([
        'email' => $this->email,
        'name' => $this->name,
        'password' => Hash::make($this->password),
    ]);

    event(new Registered($user));

    Auth::login($user, true);

    try {
        $data = Support::getFromSession();
        auth()->user()->qrCodes()->create($data);
        Support::forgetFromSession();
        return $data['is_dynamic'] ? redirect()->route('my-qrcode.dynamic') : redirect()->route('my-qrcode.static');
    } catch (\Throwable $th) {
        Support::forgetFromSession();
    }

    return redirect()->intended(route('dashboard'));
};

?>

<x-layouts.main>
    <x-slot name="seo">
        <title>Register | {{ config('app.name') }}</title>
    </x-slot>

    <div class="flex flex-col items-stretch justify-center w-screen min-h-screen py-10 sm:items-center">

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <x-ui.link href="{{ route('home') }}">
                <x-ui.logo class="w-auto h-10 mx-auto text-gray-700 fill-current dark:text-gray-100" />
            </x-ui.link>
            <h2 class="mt-5 text-2xl font-extrabold leading-9 text-center text-gray-800 dark:text-gray-200">Create a new
                account</h2>
            <div class="text-sm leading-5 text-center text-gray-600 dark:text-gray-400 space-x-0.5">
                <span>Or</span>
                <x-ui.text-link href="{{ route('login') }}">sign in to your account</x-ui.text-link>
            </div>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div
                class="px-10 py-0 sm:py-8 sm:shadow-sm sm:bg-white dark:sm:bg-gray-950/50 dark:border-gray-200/10 sm:border sm:rounded-lg border-gray-200/60">
                @volt('auth.register')
                    <div>
                        <form wire:submit="register" class="space-y-6">
                            <x-ui.input label="Name" type="name" id="name" name="name" wire:model="name" />
                            <x-ui.input label="Email address" type="email" id="email" name="email"
                                wire:model="email" />
                            <x-ui.input label="Password" type="password" id="password" name="password"
                                wire:model="password" />
                            <x-ui.input label="Confirm Password" type="password" id="password_confirmation"
                                name="password_confirmation" wire:model="passwordConfirmation" />
                            <x-ui.button type="primary" rounded="md" submit="true">Register</x-ui.button>
                        </form>
                        <a href="{{ route('login.social', 'google') }}"
                            class="inline-flex items-center justify-center w-full px-4 py-2 mt-3 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23.744 12.276c0-.825-.066-1.412-.209-2.033H12v3.851h6.905c-.14 1.163-.917 2.918-2.634 4.082l-.024.15 3.819 2.955.263.027c2.415-2.212 3.815-5.464 3.815-9.032z">
                                </path>
                                <path
                                    d="M12 24c3.24 0 5.957-1.074 7.942-2.915l-3.782-2.932c-1.073.751-2.444 1.222-4.16 1.222-3.19 0-5.896-2.156-6.861-5.067l-.142.012-3.742 2.917-.048.144c1.98 3.82 5.993 6.619 10.793 6.619z">
                                </path>
                                <path
                                    d="M5.139 14.412c-.238-.698-.375-1.44-.375-2.212s.137-1.514.375-2.212L1.35 7.071c-.838 1.558-1.323 3.311-1.323 5.129s.485 3.571 1.322 5.13l3.788-2.917z">
                                </path>
                                <path
                                    d="M12 4.777c1.734 0 3.281.599 4.497 1.775l3.338-3.338C17.951 1.463 15.233 0 12 0 7.2 0 3.187 2.8 1.207 6.618l3.743 2.917c.956-2.911 3.671-5.067 6.861-5.067z">
                                </path>
                            </svg>
                            Register with Google
                        </a>
                    </div>
                @endvolt
            </div>
        </div>

    </div>

</x-layouts.main>
