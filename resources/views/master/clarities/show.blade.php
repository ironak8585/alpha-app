@php
$links = [
'master' => null,
'diamond' => null,
'properties' => 'master.diamonds.properties',
'clarity' => null,
'detail' => null
];
@endphp

<x-app-layout :breadcrumbs="$links">

    <x-slot name="content">

        <div class="container">
            <nav class="level">
                <div class="level-left">
                    <h4 class="title is-4 has-text-primary">Clarity Detail</h1>
                </div>
                <div class="level-right">
                    <div class="field is-grouped">
                        <p class="control">
                            <a class="button is-info" href="{{ route('master.clarities.edit', $clarity->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </p>
                        <p class="control">
                            <a class="button is-primary" href="{{ route('master.diamonds.properties') }}">
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
                                    {{ $clarity->name }}
                                </p>
                            </div>
                            <div class="level-item">
                                <p class="subtitle is-5 has-text-grey">
                                    # {{ $clarity->key }}
                                </p>
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <div class="tags has-addons is-right">
                                    <span class="tag is-large">Diamond Clarity</span>
                                    <span class="tag is-large is-danger">{{ $clarity->clarity }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider">detail</div>
                    <div class="columns">
                        <div class="column is-3">
                            <x-info label="Code" :value="$clarity->code" icon="<i class='fas fa-at'></i>"></x-info>
                        </div>
                        <div class="column is-3">
                            <x-info label="Type" :value="$clarity->type" icon="<i class='fas fa-at'></i>"></x-info>
                        </div>
                        <div class="column is-3">
                            <x-info label="Value" :value="$clarity->value"></x-info>
                        </div>
                    </div>
                    <x-timestamps :record="$clarity"></x-timestamps>
                </div>
            </article>
        </div>
    </x-slot>

</x-app-layout>
