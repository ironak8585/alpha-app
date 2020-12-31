@php
$links = [
'master' => null,
'configurations' => 'master.configurations.index',
'edit' => null
];
@endphp
@extends('layouts.app', ['breadcrumbs' => $links])

@section('content')
    <div class="container">
        <nav class="level">
            <div class="level-left">
                <h4 class="title is-4 has-text-primary">Update Configuration</h4>
            </div>
            <div class="level-right">
                <a class="button is-primary" href="{{ route('master.configurations.index') }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </nav>
        <article>
            {{ Form::model($config, ['route' => ['master.configurations.update', $config->id], 'method' => 'PATCH']) }}
            <div class="card">
                <div class="card-content">
                    <div class="columns is-multiline">
                        <div class="column is-6">
                            <x-text name="key" :attributes="['disabled' => true]"></x-text>
                        </div>
                        <div class="column is-3">
                            <x-select name="category" :options="Config::get('constants.APP.CONFIG_CATEGORIES')">
                                </x-text>
                        </div>
                        <div class="column is-3">
                            <x-select name="type" :options="Config::get('constants.APP.CONFIG_TYPES')">
                                </x-text>
                        </div>
                        <div class="column is-6">
                            <x-text name="name"></x-text>
                        </div>
                        <div class="column is-3">
                            <x-text name="value"></x-text>
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
@endsection
