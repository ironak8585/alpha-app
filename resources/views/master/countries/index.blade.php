@php
$links = [
'master' => null,
'countries' => 'master.countries.index'
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
                    <h1 class="title has-text-primary">Countries</h1>
                </div>
                <div class="level-right">
                    <a class="button is-primary is-outlined mr-3 has-tooltip-primary has-tooltip-bottom has-tooltip-arrow"
                        data-tooltip="Import" href="{{ route('master.countries.import') }}">
                        <span class="icon">
                            <i class="fas fa-file-import"></i>
                        </span>
                    </a>
                    {{ Form::open(['method' => 'POST', 'route' => ['master.countries.export']]) }}
                    <button type="submit"
                        class="button is-primary is-outlined mr-3 has-tooltip-primary has-tooltip-bottom has-tooltip-arrow"
                        data-tooltip="Export">
                        <span class="icon">
                            <i class="fas fa-file-export"></i>
                        </span>
                    </button>
                    {{ Form::close() }}
                    <div class="buttons">
                        <a class="button is-info is-outlined" href="{{ route('master.countries.create') }}">
                            <span class="icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span>Create New</span>
                        </a>
                        <x-filter-panel :fields="$fields" :filters="$filters" route="master.countries">
                        </x-filter-panel>
                    </div>
                </div>
            </nav>
            <div class="box">
                <div class="table-container">
                    <table class="table is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th class="has-text-right has-text-link">
                                    <i class="fas fa-tasks"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $record->name }}</td>
                                    <td>
                                        <div class="field buttons are-small is-grouped is-grouped-right">
                                            <x-default-action route-prefix="master.countries" :id="$record->id"
                                                :show="true">
                                            </x-default-action>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <x-pagination :records="$records" :filters="$filters"></x-pagination>
        </div>
    </x-slot>


</x-app-layout>
