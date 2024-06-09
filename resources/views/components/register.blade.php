<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{state, rules};

state(['name' => '', 'email' => '', 'password' => '', 'passwordConfirmation' => '']);
rules(['name' => 'required', 'email' => 'required|email|unique:users', 'password' => 'required|min:8|same:passwordConfirmation']);

$register = function(){
    $this->validate();

    $user = User::create([
        'email' => $this->email,
        'name' => $this->name,
        'password' => Hash::make($this->password),
    ]);

    event(new Registered($user));

    Auth::login($user, true);

    $this->dispatch('toast', message: 'Successfully registered.', data: [ 'position' => 'top-right', 'type' => 'success' ]);
    $this->js('document.getElementById("closeModalRegister").click()');
    return redirect()->intended(route('my-qrcode.create'));

}

?>

<div data-te-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="registerModal" tabindex="-1" aria-labelledby="registerModal" aria-hidden="true">
    <div data-te-modal-dialog-ref
        class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div
            class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600 ">
            <div
                class="flex items-center justify-end flex-shrink-0 p-4 rounded-t-md">

                <button type="button" id="closeModalRegister"
                    class="box-content border-none rounded-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                    data-te-modal-dismiss aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="relative flex-auto p-4" data-te-modal-body-ref>
                <div class="flex flex-col items-stretch justify-center py-10 pt-5 pb-5 sm:items-center">

                    <div class="sm:mx-auto sm:w-full sm:max-w-md">
                        <x-ui.link href="{{ route('home') }}">
                            <x-ui.logo class="w-auto h-10 mx-auto text-gray-700 fill-current dark:text-gray-100" />
                        </x-ui.link>
                        <h2 class="mt-5 text-2xl font-extrabold leading-9 text-center text-gray-800 dark:text-gray-200">
                            Create a new account</h2>
                        <div class="text-sm leading-5 text-center text-gray-600 dark:text-gray-400 space-x-0.5"
                            data-te-modal-dismiss>
                            <span>Or</span>
                            <div data-te-ripple-init data-te-ripple-color="light" data-te-toggle="modal"
                                data-te-target="#loginModal" data-te-ripple-init data-te-ripple-color="light"
                                class="px-2 py-1 text-blue-500 cursor-pointer">
                                Sign in to your account</div>
                        </div>
                    </div>

                    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                        <div
                            class="px-10 py-0 sm:py-8">
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
                                <a href="{{ url('auth/google') }}" class="inline-flex items-center justify-center w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M23.744 12.276c0-.825-.066-1.412-.209-2.033H12v3.851h6.905c-.14 1.163-.917 2.918-2.634 4.082l-.024.15 3.819 2.955.263.027c2.415-2.212 3.815-5.464 3.815-9.032z"></path>
                                        <path d="M12 24c3.24 0 5.957-1.074 7.942-2.915l-3.782-2.932c-1.073.751-2.444 1.222-4.16 1.222-3.19 0-5.896-2.156-6.861-5.067l-.142.012-3.742 2.917-.048.144c1.98 3.82 5.993 6.619 10.793 6.619z"></path>
                                        <path d="M5.139 14.412c-.238-.698-.375-1.44-.375-2.212s.137-1.514.375-2.212L1.35 7.071c-.838 1.558-1.323 3.311-1.323 5.129s.485 3.571 1.322 5.13l3.788-2.917z"></path>
                                        <path d="M12 4.777c1.734 0 3.281.599 4.497 1.775l3.338-3.338C17.951 1.463 15.233 0 12 0 7.2 0 3.187 2.8 1.207 6.618l3.743 2.917c.956-2.911 3.671-5.067 6.861-5.067z"></path>
                                    </svg>
                                    Login with Google
                                </a>
                                <x-ui.button type="primary" rounded="md" submit="false" tag="a"
                                    href="{{ route('login.social', 'google') }}"
                                    style="margin-top: 10px;background-color: #dd4b39;border-color: #dd4b39;">
                                    Sign in with Google
                                </x-ui.button>
                            </div>
                            @endvolt
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
