@php
$links = [
'master' => null,
'diamond' => null,
'properties' => 'master.diamond.properties'
];
@endphp
<x-app-layout :breadcrumbs="$links">

    <x-slot name="content">
        @php
        $property = Session::get('property') ?? 'color';
        @endphp
        <div class="container">
            <div class="tabs is-boxed">
                <ul>
                    <li class="tab {{ $property == 'color' ? 'is-active' : '' }}" data-content="colors"><a
                            class="subtitle">Colors</a></li>
                    <li class="tab {{ $property == 'shape' ? 'is-active' : '' }}" data-content="shapes"><a
                            class="subtitle">Shapes</a></li>
                    <li class="tab {{ $property == 'intensity' ? 'is-active' : '' }}" data-content="intensities"><a
                            class="subtitle">Intensities</a></li>
                    <li class="tab {{ $property == 'clarity' ? 'is-active' : '' }}" data-content="clarities"><a
                            class="subtitle">Clarities</a></li>
                    <li class="tab {{ $property == 'cut' ? 'is-active' : '' }}" data-content="cuts"><a
                            class="subtitle">Cuts</a></li>
                    <li class="tab {{ $property == 'polish' ? 'is-active' : '' }}" data-content="polishes"><a
                            class="subtitle">Polishes</a></li>
                    <li class="tab {{ $property == 'symmetry' ? 'is-active' : '' }}" data-content="symmetries"><a
                            class="subtitle">Symmetries</a></li>
                    <li class="tab {{ $property == 'fluroscence' ? 'is-active' : '' }}" data-content="fluroscences"><a
                            class="subtitle">Fluroscences</a></li>
                    <li class="tab {{ $property == 'lab' ? 'is-active' : '' }}" data-content="labs"><a
                            class="subtitle">Labs</a></li>
                </ul>
            </div>
            <div id="colors" class="tab-content {{ $property != 'color' ? 'is-hidden' : '' }}">
                @include('master.diamonds.property', [
                'property' => 'Colors',
                'records' => $colors,
                'route' => 'master.colors'
                ])
            </div>
            <div id="shapes" class="tab-content {{ $property != 'shape' ? 'is-hidden' : '' }}">
                @include('master.diamonds.property', [
                'property' => 'Shapes',
                'records' => $shapes,
                'route' => 'master.shapes'
                ])
            </div>
            <div id="intensities" class="tab-content {{ $property != 'intensity' ? 'is-hidden' : '' }}">
                @include('master.diamonds.property', [
                'property' => 'Intensities',
                'records' => $intensities,
                'route' => 'master.intensities'
                ])
            </div>
            <div id="clarities" class="tab-content {{ $property != 'clarity' ? 'is-hidden' : '' }}">
                @include('master.diamonds.propertywithcode', [
                'property' => 'Clarities',
                'records' => $clarities,
                'route' => 'master.clarities'
                ])
            </div>
            <div id="cuts" class="tab-content {{ $property != 'cut' ? 'is-hidden' : '' }}">
                @include('master.diamonds.propertywithcode', [
                'property' => 'Cuts',
                'records' => $cuts,
                'route' => 'master.cuts'
                ])
            </div>
            <div id="polishes" class="tab-content {{ $property != 'polish' ? 'is-hidden' : '' }}">
                @include('master.diamonds.propertywithcode', [
                'property' => 'Polishes',
                'records' => $polishes,
                'route' => 'master.polishes'
                ])
            </div>
            <div id="symmetries" class="tab-content {{ $property != 'symmetry' ? 'is-hidden' : '' }}">
                @include('master.diamonds.propertywithcode', [
                'property' => 'Symmetries',
                'records' => $symmetries,
                'route' => 'master.symmetries'
                ])
            </div>
            <div id="fluroscences" class="tab-content {{ $property != 'fluroscence' ? 'is-hidden' : '' }}">
                @include('master.diamonds.property', [
                'property' => 'Fluroscences',
                'records' => $fluroscences,
                'route' => 'master.fluroscences'
                ])
            </div>
            <div id="labs" class="tab-content {{ $property != 'lab' ? 'is-hidden' : '' }}">
                @include('master.diamonds.propertywithcode', [
                'property' => 'Labs',
                'records' => $labs,
                'route' => 'master.labs'
                ])
            </div>
        </div>
    </x-slot>
</x-app-layout>
