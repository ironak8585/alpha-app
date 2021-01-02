@php
$links = [
'admin' => null,
'users' => 'admin.users.index',
'create' => null
];
@endphp

<x-app-layout :breadcrumbs="$links">
    <x-slot name="content">
        <div class="container">
            <nav class="level">
                <div class="level-left">
                    <h4 class="title is-4 has-text-primary">Create New User</h1>
                </div>
                <div class="level-right">
                    <a class="button is-primary" href="{{ route('admin.users.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </nav>
            <article>
                {{ Form::open(['route' => 'admin.users.store', 'method' => 'POST']) }}
                <div class="tile is-ancestor">
                    <div class="tile is-parent is-8">
                        <div class="tile is-child box">
                            <article>
                                <p class="subtitle has-text-info">User Information</p>
                                <div class="divider"></div>
                                <div class="columns is-multiline">
                                    <div class="column is-6">
                                        <x-text name="name"></x-text>
                                    </div>
                                    <div class="column is-8">
                                        <x-email name="email"></x-email>
                                    </div>
                                    <div class="column is-4">
                                        <x-mobile name="phone"></x-mobile>
                                    </div>
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
                            </article>
                        </div>
                    </div>
                    <div class="tile is-parent is-4">
                        <div class="tile is-child box">
                            <article>
                                <p class="subtitle has-text-info">Select Roles</p>
                                <div class="divider"></div>
                                <x-checkbox name="roles[]" :label="false" :options="$roles"></x-checkbox>
                            </article>
                        </div>
                    </div>
                </div>
                {{ Form::submit('Save', ['class' => 'button is-primary']) }}
                {{ Form::close() }}
            </article>
        </div>
    </x-slot>
</x-app-layout>
