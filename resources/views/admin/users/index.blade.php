@php
$links = [
'admin' => null,
'users' => 'admin.users.index'
];
$fields = [
'name' => ['text', 'Name'],
'email' => ['text', 'Email Address'],
'role' => ['select', 'Role', $roles]
]
@endphp

<x-app-layout :breadcrumbs="$links">
    <x-slot name="content">
        <div class="container">
            <nav class="level">
                <div class="level-left">
                    <h1 class="title has-text-primary">Users</h1>
                </div>
                <div class="level-right">
                    <div class="buttons">
                        <a class="button is-info is-outlined" href="{{ route('admin.users.create') }}">
                            <span class="icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span>Create New</span>
                        </a>
                        <x-filter-panel :fields="$fields" :filters="$filters" route="admin.users"></x-filter-panel>
                    </div>
                </div>
            </nav>
            <div class="tile is-ancestor">
                <div class="tile is-vertical">
                    @foreach ($records as $user)
                        <div class="tile is-parent">
                            <div class="tile is-child">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4 has-text-info">
                                            {{ $user->name }}
                                        </p>
                                        <div class="columns">
                                            <div class="column is-8">
                                                <div class="columns">
                                                    <div class="column">
                                                        <x-info label="Username" :value="$user->email"></x-info>
                                                    </div>
                                                    <div class="column">
                                                        <x-info label="Phone" :value="$user->phone"></x-info>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <div class="tags has-addons">
                                                        <span class="tag is-medium">Last logged @</span>
                                                        <span
                                                            class="tag is-medium is-success">{{ $user->logged_at ? $user->logged_at->format('d-m-Y') : 'Not logged' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-4">
                                                <div class="divider my-3">Roles</div>
                                                <ul>
                                                    @foreach ($user->roles as $role)
                                                        <li class="my-3">
                                                            <div class="level is-mobile">
                                                                <div class="level-left">
                                                                    <p>{{ $role->name }}</p>
                                                                </div>
                                                                <div class="level-right">
                                                                    {{ Form::open(['method' => 'post', 'route' => ['admin.users.roles.remove', $user, $role->name], 'class' => 'form-confirm']) }}
                                                                    <button type="submit"
                                                                        class="button is-danger is-inverted">
                                                                        <i class="fas fa-minus-square"></i>
                                                                    </button>
                                                                    {{ Form::close() }}
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <footer class="card-footer">
                                        <div class="control">
                                            <a class="button is-info is-inverted is-borderless"
                                                href="{{ route('admin.users.password', $user->code) }}">
                                                <i class="fas fa-unlock-alt is-small"></i>
                                            </a>
                                        </div>
                                        <x-default-action route-prefix="admin.users" :id="$user->code" :show="false">
                                        </x-default-action>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <x-pagination :records="$records" :filters="$filters"></x-pagination>
        </div>
    </x-slot>
</x-app-layout>
