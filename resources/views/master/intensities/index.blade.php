@php
$links = [
'master' => null,
'intensities' => 'master.intensities.index'
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
                    <h1 class="title has-text-primary">Diamond Colors</h1>
                </div>
                <div class="level-right">
                    <div class="buttons">
                        <a class="button is-info is-outlined" href="{{ route('master.intensities.create') }}">
                            <span class="icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span>Create New</span>
                        </a>
                        <x-filter-panel :fields="$fields" :filters="$filters" route="master.intensities">
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
                                    <td>{{ $record->name }}</td>
                                    <td>{{ $record->color_type }}</td>
                                    <td>
                                        <div class="field buttons are-small is-grouped is-grouped-right">
                                            <x-default-action route-prefix="master.intensities" :id="$record->id"
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
