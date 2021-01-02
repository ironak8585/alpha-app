@php
$links = [
'admin' => null,
'roles' => 'admin.roles.index',
'edit' => null
];
@endphp


<x-app-layout :breadcrumbs="$links">
    <x-slot name="content">
        <div class="container">
            <nav class="level">
                <div class="level-left">
                    <h4 class="title is-4 has-text-primary">Update Role</h4>
                </div>
                <div class="level-right">
                    <a class="button is-primary" href="{{ route('admin.roles.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </nav>
            <article>
                {{ Form::model($role, ['route' => ['admin.roles.update', $role->id], 'method' => 'PATCH']) }}
                <div class="tile is-ancestor">
                    <div class="tile is-parent is-8">
                        <div class="tile is-child box">
                            <article>
                                <p class="subtitle has-text-info">Role Information</p>
                                <div class="divider"></div>
                                <div class="columns is-multiline">
                                    <div class="column is-6">
                                        <x-text name="name"></x-text>
                                    </div>
                                    <div class="column is-6">
                                        <x-text name="guard_name"></x-text>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="tile is-parent is-4">
                        <div class="tile is-child box">
                            <article>
                                <p class="subtitle has-text-info">Select Permissions</p>
                                <div class="divider"></div>
                                <x-checkbox name="permissions[]" :label="false" :options="$permissions"
                                    :value="$role->permissions->pluck('name')->all()"></x-checkbox>
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
