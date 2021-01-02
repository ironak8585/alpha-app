@php
$links = [
'admin' => null,
'users' => 'admin.users.index',
'password' => null
];
@endphp

<x-app-layout :breadcrumbs="$links">
    <x-slot name="content">
        <div class="container">
            <nav class="level">
                <div class="level-left">
                    <h4 class="title is-4 has-text-primary">Set New Password</h4>
                </div>
                <div class="level-right">
                    <a class="button is-primary" href="{{ route('admin.users.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </nav>
            <article>
                {{ Form::model($user, ['route' => ['admin.users.password', $user->code], 'method' => 'POST']) }}
                <div class="card">
                    <div class="card-content">
                        <p class="title is-4 has-text-info">
                            {{ $user->name }}
                        </p>
                        <div class="columns">
                            <div class="column is-6">
                                <div class="field">
                                    <label for="password">Password</label>
                                    <div class="control has-icons-left">
                                        {{ Form::password('password', ['class' => 'input', 'required' => true]) }}
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6">
                                <div class="field">
                                    <label for="password">Confirm Password</label>
                                    <div class="control has-icons-left">
                                        {{ Form::password('password_confirmation', ['class' => 'input', 'required' => true]) }}
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="card-footer-item justify-content-start">
                            {{ Form::submit('Save', ['class' => 'button is-primary']) }}
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </article>
        </div>
    </x-slot>
</x-app-layout>
