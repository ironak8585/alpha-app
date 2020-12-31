<div class="control">
    {{ Form::open(['method' => 'POST', 'route' => $route, 'class' => $confirm]) }}
    <button type="submit" class="button is-inverted is-borderless {{ $color }} {{ $tooltip ? 'has-tooltip-info has-tooltip-bottom has-tooltip-arrow' : '' }}" data-tooltip={{ $tooltip }}>
        <span class="icon">
            <i class="fas is-small {{ $icon }}"></i>
        </span>
        @if ($title)
        <span>{{ $title }}</span>    
        @endif        
    </button>
    {{ Form::close() }}
</div>