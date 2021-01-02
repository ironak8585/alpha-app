@php
$links = [
'admin' => null,
'permissions' => 'admin.permissions.index',
'edit' => null
];
@endphp

<x-app-layout :breadcrumbs="$links">
    <x-slot name="content">
        <div class="container">
            <nav class="level">
                <div class="level-left">
                    <h4 class="title is-4 has-text-primary">Update Permission</h4>
                </div>
                <div class="level-right">
                    <a class="button is-primary" href="{{ route('admin.permissions.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </nav>
            <article>
                {{ Form::model($permission, ['route' => ['admin.permissions.update', $permission->id], 'method' => 'PATCH']) }}
                <div class="card">
                    <div class="card-content">
                        <div class="columns is-multiline">
                            <div class="column is-8">
                                <x-text name="name"></x-text>
                            </div>
                            <div class="column is-4">
                                <x-text name="guard_name"></x-text>
                            </div>
                            <div class="column is-12">
                                <x-text name="description"></x-text>
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
