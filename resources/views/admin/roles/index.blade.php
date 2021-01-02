@php
$links = [
'admin' => null,
'roles' => 'admin.roles.index'
];
$fields = [
'name' => ['text', 'Name'],
]
@endphp

<x-app-layout :breadcrumbs="$links">
    <x-slot name="content">
        <div class="container">
            <nav class="level">
                <div class="level-left">
                    <h1 class="title has-text-primary">Roles</h1>
                </div>
                <div class="level-right">
                    <div class="buttons">
                        <a class="button is-info is-outlined" href="{{ route('admin.roles.create') }}">
                            <span class="icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span>Create New</span>
                        </a>
                        <x-filter-panel :fields="$fields" :filters="$filters" route="admin.roles"></x-filter-panel>
                    </div>
                </div>
            </nav>
            <div class="tile is-ancestor">
                <div class="tile is-vertical">
                    <div class="tile">
                        @foreach ($records as $role)
                            <div class="tile is-parent is-6">
                                <div class="tile is-child">
                                    <div class="card">
                                        <div class="card-content">
                                            <p class="title is-4 has-text-info">
                                                {{ $role->name }}
                                                <span class="tag is-pulled-right">{{ $role->guard_name }}</span>
                                            </p>
                                            <div class="divider my-3">Permissions</div>
                                            <div class="tags">
                                                @foreach ($role->permissions as $perm)
                                                    <span class="tag">{{ $perm->description }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <footer class="card-footer">
                                            <x-default-action route-prefix="admin.roles" :id="$role->id" :show="false">
                                            </x-default-action>
                                        </footer>
                                    </div>
                                </div>
                            </div>
                            @if ($loop->iteration % 2 == 0)
                    </div>
                    <div class="tile">
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <x-pagination :records="$records" :filters="$filters"></x-pagination>
        </div>
    </x-slot>
</x-app-layout>
