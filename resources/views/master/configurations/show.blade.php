@php
$links = [
'master' => null,
'configurations' => 'master.configurations.index',
'detail' => null
];
@endphp

<x-app-layout :breadcrumbs="$links">

    <x-slot name="content">

        <div class="container">
            <nav class="level">
                <div class="level-left">
                    <h4 class="title is-4 has-text-primary">Configuration Detail</h1>
                </div>
                <div class="level-right">
                    <div class="field is-grouped">
                        <p class="control">
                            <a class="button is-info" href="{{ route('master.configurations.edit', $config->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </p>
                        <p class="control">
                            <a class="button is-primary" href="{{ route('master.configurations.index') }}">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </nav>
            <article>
                <div class="box">
                    <div class="level mb-0">
                        <div class="level-left">
                            <div class="level-item">
                                <p class="title has-text-info">
                                    {{ $config->name }}
                                </p>
                            </div>
                            <div class="level-item">                                
                                <p class="subtitle is-5 has-text-grey">
                                    # {{ $config->key }}
                                </p>
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <div class="tags has-addons is-right">
                                    <span class="tag is-large">Category</span>
                                    <span class="tag is-large is-danger">{{ $config->category }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider">detail</div>
                    <div class="columns">
                        <div class="column is-3">
                            <x-info label="Type" :value="$config->type" icon="<i class='fas fa-at'></i>"></x-info>
                        </div>
                        <div class="column is-3">
                            <x-info label="Value" :value="$config->value"></x-info>
                        </div>
                    </div>
                    <x-timestamps :record="$config"></x-timestamps>
                </div>
            </article>
        </div>
    </x-slot>

</x-app-layout>
