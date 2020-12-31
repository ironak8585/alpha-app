@if ($show)
<div class="control">
    <a class="button is-info is-inverted is-borderless" href="{{ route($routePrefix . ".show", $id) }}">
        <i class="fas fa-info is-small"></i>
    </a>
</div>
@endif

@if ($edit)
<div class="control">
    <a class="button is-info is-inverted is-borderless" href="{{ route($routePrefix . ".edit", $id) }}">
        <i class="fas fa-edit is-small"></i>
    </a>
</div>
@endif

@if ($delete)
<div class="control">
    {{ Form::open(['method' => 'delete', 'route' => [$routePrefix. '.destroy', $id], 'class' => 'form-confirm'])}}
    <button type="submit" class="button is-danger is-inverted is-borderless">
        <i class="fas fa-trash-alt is-small"></i>
    </button>
    {{ Form::close() }}
</div>
@endif