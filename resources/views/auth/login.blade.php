<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <figure class="image is-128x128 is-margin-auto">
                    <x-application-logo class="" />
                </figure>
            </a>
        </x-slot>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <label class="label">{{ __('E-Mail Address') }}</label>
            <div class="field has-addons">
                <div class="control has-icons-left">
                    <input name="email" type="text" class="input @error('email') is-danger @enderror"
                        placeholder="Username">
                    <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
            </div>
            @error('email')
                <p class="help is-danger">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror

            <div class="field">
                <label class="label">{{ __('Password') }}</label>
                <div class="control has-icons-left">
                    <input name="password" type="password" class="input @error('password') is-danger @enderror"
                        placeholder="Password" required autocomplete="current-password">
                    <span class="icon is-small is-left">
                        <i class="fas fa-key"></i>
                    </span>
                </div>
            </div>
            @error('password')
                <p class="help is-danger">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror

            <!-- Remember Me -->
            {{--
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            --}}

            <div class="">
                <x-submit class="">
                    {{ __('Login') }}
                </x-submit>
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Signup?') }}
                </a>
                @if (Route::has('password.request'))
                    <a class="" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
