@php
$links = [
    'master' => null,
    'configurations' => 'master.configurations.index'
];
$fields = [
    'name' => ['text', 'Name'],
    'number' => ['number', 'Number'],
    'select' => ['select', 'Select', ['One', 'Two']],
    'date' => ['date', 'Date'],
    'nrange' => ['range', 'number', 'Number Range'],
    'drange' => ['range', 'date', 'Date Range'],
]
@endphp
<x-app-layout :breadcrumbs="$links">
    
    <x-slot name="content">
        <div class="container">
            <nav class="level">
                <div class="level-left">
                    <h1 class="title has-text-primary">Configurations</h1>
                </div>
                <div class="level-right">
                    <div class="buttons">
                        <a class="button is-info is-outlined" href="{{ route('master.configurations.create') }}">
                            <span class="icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span>Create New</span>
                        </a>
                        <x-filter-panel :fields="$fields" :filters="$filters" route="master.configurations">
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
                                <th>Category</th>
                                <th>Name</th>
                                <th>Key</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th class="has-text-right has-text-link">
                                    <i class="fas fa-tasks"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $record->category }}</td>
                                    <td>{{ $record->name }}</td>
                                    <td>{{ $record->key }}</td>
                                    <td>{{ $record->value }}</td>
                                    <td>{{ $record->type }}</td>
                                    <td>
                                        <div class="field buttons are-small is-grouped is-grouped-right">
                                            <x-default-action route-prefix="master.configurations" :id="$record->id"
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