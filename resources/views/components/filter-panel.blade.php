<a class="button is-primary has-tooltip-primary has-tooltip-bottom has-tooltip-arrow" data-show="quickview"
    data-target="quickviewDefault" data-tooltip="Filter Panel">
    <span class="icon">
        <i class="fas fa-filter"></i>
    </span>
</a>
@php
    $disabled = count($filters) == 0 ? 'disabled' : '';
@endphp
<button id="FilterClear" class="button is-success mr-0 has-tooltip-success has-tooltip-bottom has-tooltip-arrow" {{ $disabled }} data-tooltip="Clear All Filters">
    <span class="icon is-primary">
        <i class="fas fa-times"></i>
    </span>                    
</button> 

<div id="quickviewDefault" class="quickview">
    <header class="quickview-header">
        <span class="icon is-primary">
            <i class="fas fa-filter"></i>
        </span>
        <div class="field is-grouped is-pulled-left">
            <p class="control">
                <button id="FilterSearch" class="button mb-0 is-borderless is-primary has-tooltip-primary has-tooltip-bottom has-tooltip-arrow" data-tooltip="Apply">
                    <span class="icon">
                        <i class="fas fa-check"></i>
                    </span>
                </button>
            </p>
            <p class="control">
                <button class="button is-light is-borderless mb-0" data-dismiss="quickview">
                    <span class="icon">
                        <i class="fas fa-times"></i>
                    </span>      
                </button>
            </p>
        </div>        
    </header>

    <div class="quickview-body">
        <div class="quickview-block">
            <div class="container">
                <div class="section py-5">
                    @foreach ($fields as $name => $item)
                        @switch($item[0])
                            @case('text')
                                <x-text :name="$name" :label="$item[1]"></x-text>
                                @break
                            @case('number')
                                <x-number :name="$name" :label="$item[1]"></x-number>
                                @break
                            @case('select')
                                <x-select :name="$name" :label="$item[1]" :options="$item[2]" :value="null" placeholder="ALL"></x-select>
                                @break
                            @case('auto')
                                <x-autocomplete :name="$name" :label="$item[1]" :options="$item[2]"></x-autocomplete>
                                @break
                            @case('date')
                                <x-datepicker :name="$name" :label="$item[1]"></x-datepicker>
                                @break
                            @case('range')
                                @switch($item[1])
                                    @case('number')
                                        <div class="columns">
                                            <div class="column is-6">
                                                <x-number :name="$name . '_from'" :label="$item[2]"></x-number>
                                            </div>
                                            <div class="column is-6">
                                                <label for="" class="label">&nbsp;</label>
                                                <x-number :name="$name . '_to'" :label="false"></x-number>
                                            </div>
                                        </div>
                                        @break
                                    @case('date')
                                        <x-datepicker :name="$name . '_from'" :label="$item[2]"></x-datepicker>
                                        <div class="divider px-6 mt-0 mb-3">to</div>
                                        <x-datepicker :name="$name . '_to'" :label="false"></x-datepicker>
                                        @break
                                    @default
                                @endswitch
                            @break
                            @default
                                <x-text :name="$name"></x-text>
                        @endswitch
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{-- <footer class="quickview-footer"></footer> --}}
</div>
<script src="{{ asset('js/filter.js') }}"></script>
<script type="text/javascript">    
    let filter;
    $(document).ready(function () {        
        const webroot = "{{ URL::to('/')}}";
        const route = "{{ $route }}";
        filter = new Filter($(this), webroot, route, '<?= json_encode($filters); ?>');
        filter.initFilterPanel();
        $('#quickviewDefault').keypress(function (event) {
            const keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                filter.search();
            }
        });
    });
</script>