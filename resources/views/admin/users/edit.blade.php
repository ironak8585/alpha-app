@php
$links = [
'admin' => null,
'users' => 'admin.users.index',
'edit' => null
];
@endphp

<x-app-layout :breadcrumbs="$links">
    <x-slot name="content">
        <div class="container">
            <nav class="level">
                <div class="level-left">
                    <h4 class="title is-4 has-text-primary">Update User</h4>
                </div>
                <div class="level-right">
                    <a class="button is-primary" href="{{ route('admin.users.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </nav>
            <div class="tile">
                <div class="tile is-parent is-8">
                    <div class="tile is-child">
                        <article>
                            {{ Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PATCH']) }}
                            <div class="card">
                                <div class="card-content">
                                    <p class="subtitle has-text-info">User Detail</p>
                                    <div class="columns is-multiline">
                                        <div class="column is-6">
                                            <x-text name="name"></x-text>
                                        </div>
                                        <div class="column is-6">
                                            <x-email name="email"></x-email>
                                        </div>
                                        <div class="column is-4">
                                            <x-mobile name="phone" :value="$user->phone"></x-mobile>
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
                </div>
                <div class="tile is-parent is-4">
                    <div class="tile is-child">
                        <article>
                            @if ($roles->isEmpty())
                                <div class="box">
                                    <x-not-found message="All roles are assigned to user."></x-not-found>
                                </div>
                            @else
                                {{ Form::open(['route' => 'admin.users.roles.add', 'method' => 'POST']) }}
                                {{ Form::token() }}
                                {{ Form::hidden('user', $user->id) }}
                                <div class="card">
                                    <div class="card-content">
                                        <p class="subtitle has-text-info">Assign Roles</p>
                                        
                                        <x-checkbox name="roles[]" :label="false" :options="$roles" :value="$user->roles->pluck('name')->all()"></x-checkbox>
                                    </div>
                                    <div class="card-footer">
                                        <div class="card-footer-item justify-content-start">
                                            {{ Form::submit('Save', ['class' => 'button is-primary']) }}
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            @endif
                        </article>
                    </div>
                </div>
            </div>

        </div>
    </x-slot>
</x-app-layout>
