<x-guest-layout>
    <x-auth-card>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <label class="label">{{ __('E-Mail Address') }}</label>
            <div class="field">
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

            <div class="level">
                <div class="level-left">
                    <x-submit class="is-primary mr-2">
                        {{ __('Login') }}
                    </x-submit>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <a class="button" href="{{ route('register') }}">
                            {{ __('Signup?') }}
                        </a>
                    </div>
                    <div class="level-item">
                        @if (Route::has('password.request'))
                            <a class="" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>

    </x-auth-card>
</x-guest-layout>
