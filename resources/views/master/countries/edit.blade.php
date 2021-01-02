@php
$links = [
'master' => null,
'countries' => 'master.countries.index',
'edit' => null
];
@endphp

<x-app-layout :breadcrumbs="$links">
    <x-slot name="content">
        <div class="container">
            <nav class="level">
                <div class="level-left">
                    <h4 class="title is-4 has-text-primary">Update Country</h4>
                </div>
                <div class="level-right">
                    <a class="button is-primary" href="{{ route('master.countries.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </nav>
            <article>
                {{ Form::model($country, ['route' => ['master.countries.update', $country->id], 'method' => 'PATCH']) }}
                <div class="card">
                    <div class="card-content">
                        <div class="columns is-multiline">                            
                            <div class="column is-6">
                                <x-text name="name"></x-text>
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
