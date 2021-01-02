<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <figure class="image is-128x128 is-margin-auto">
                    <x-application-logo class="" />
                </figure>
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="field">
                <label class="label">{{ __('Name of User') }}</label>
                <div class="control has-icons-left">
                    <input name="name" type="text" value="{{ old('name') }}"
                        class="input @error('name') is-danger @enderror" placeholder="Name of user" required
                        autocomplete="name" autofocus>
                    <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                @error('name')
                    <p class="help is-danger">
                        <strong>{{ $message }}</strong>
                    </p>
                @enderror
            </div>
            <div class="field">
                <label class="label">{{ __('E-Mail Address') }}</label>
                <div class="control has-icons-left">
                    <input name="email" type="email" class="input @error('email') is-danger @enderror"
                        placeholder="Username" value="{{ old('email') }}" required autocomplete="email">
                    <span class="icon is-small is-left">
                        <i class="fas fa-at"></i>
                    </span>
                </div>
                @error('email')
                    <p class="help is-danger">
                        <strong>{{ $message }}</strong>
                    </p>
                @enderror
            </div>
            <div class="field">
                <label class="label">{{ __('Password') }}</label>
                <div class="control has-icons-left">
                    <input name="password" type="password" class="input @error('password') is-danger @enderror"
                        placeholder="Password" required autocomplete="new-password">
                    <span class="icon is-small is-left">
                        <i class="fas fa-key"></i>
                    </span>
                </div>
                @error('password')
                    <p class="help is-danger">
                        <strong>{{ $message }}</strong>
                    </p>
                @enderror
            </div>
            <div class="field">
                <label class="label">{{ __('Confirm Password') }}</label>
                <div class="control has-icons-left">
                    <input id="password-confirm" type="password" class="input" name="password_confirmation" required
                        autocomplete="new-password">
                    <span class="icon is-small is-left">
                        <i class="fas fa-key"></i>
                    </span>
                </div>
                @error('password')
                    <p class="help is-danger">
                        <strong>{{ $message }}</strong>
                    </p>
                @enderror
            </div>

            <div class="level">
                <div class="level-left">
                    <x-submit class="is-primary">
                        {{ __('Register') }}
                    </x-submit>
                </div>
                <div class="level-right">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
