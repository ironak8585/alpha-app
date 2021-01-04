@php
$links = [
'master' => null,
'intensities' => 'master.intensities.index',
'create' => null
];
@endphp

<x-app-layout :breadcrumbs="$links">

    <x-slot name="content">
        <div class="container">
            <nav class="level">
                <div class="level-left">
                    <h4 class="title is-4 has-text-primary">Create New Diamond Color Intensity</h1>
                </div>
                <div class="level-right">
                    <a class="button is-primary" href="{{ route('master.intensities.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </nav>
            <article>
                {{ Form::open(['route' => 'master.intensities.store', 'method' => 'POST']) }}
                <div class="card">
                    <div class="card-content">
                        <div class="columns is-multiline">
                            <div class="column is-6">
                                <x-text name="name"></x-text>
                            </div>
                        </div>
                        <div class="columns is-6">
                            <div class="column is-6">
                                <x-checkbox name="is_white"></x-checkbox>
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
