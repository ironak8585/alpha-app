@php
$links = [
'master' => null,
'countries' => 'master.countries.index',
'import' => null
];
@endphp

<x-app-layout :breadcrumbs="$links">

    <x-slot name="content">
        <div class="container">
            <nav class="level">
                <div class="level-left">
                    <h4 class="title is-4 has-text-primary">Import Countries</h1>
                </div>
                <div class="level-right">
                    <a class="button is-primary" href="{{ route('master.countries.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </nav>
            <article>
                <div class="columns">
                    <div class="column is-6">
                        {{ Form::open(['route' => 'master.countries.import', 'method' => 'POST', 'files' => true]) }}
                        <div class="card">
                            <div class="card-content">
                                <div class="columns">
                                    <div class="column">
                                        <x-file name="file" placeholder="Select file" label="Country File" type="excel">
                                        </x-file>
                                    </div>
                                </div>
                            </div>
                            <footer class="card-footer">
                                <div class="card-footer-item justify-content-start">
                                    {{ Form::submit('Upload', ['class' => 'button is-primary']) }}
                                </div>
                            </footer>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <div class="column is-6">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Format
                                </p>
                            </header>
                            <div class="card-content">
                                <table class="table is-bordered is-uppercase">
                                    <thead>
                                        <tr>
                                            <th>name</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <footer class="card-footer">
                                <div class="card-footer-item justify-content-start">
                                    <a class="button is-info"
                                        href="{{ asset('storage/formats/master/countries.xlsx') }}" target="blnk">
                                        Download
                                    </a>
                                </div>
                            </footer>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </x-slot>
</x-app-layout>
