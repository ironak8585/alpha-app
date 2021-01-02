<x-guest-layout>
    <x-auth-card>

        <div class="subtitle">
            {{ __('Forgot Password') }}
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="columns">
                <div class="column">
                    <x-email name="email" :value="old('email')"></x-email>                
                </div>                
            </div>
            
            <div class="level">
                <div class="level-left">
                    <x-submit class="is-primary mr-2">
                        {{ __('Send Link') }}
                    </x-submit>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <a class="button" href="{{ route('login') }}">
                            {{ __('Login?') }}
                        </a>
                    </div>
                    <div class="level-item">
                        <a class="button" href="{{ route('register') }}">
                            {{ __('Signup?') }}
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
