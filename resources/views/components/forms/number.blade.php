<div class="field">
    @if ($label)
    {{ Form::label($id, $label, ['class' => 'label']) }}
    @endif
    <div class="control {{ $icon ? 'has-icons-left' : '' }}">
        {{ Form::number($name, $value, $attr) }}
        @if ($icon)
        <span class="icon is-small is-left">
            <i class="fas fa-sort-numeric-down"></i>
        </span>
        @endif
    </div>
    @if (isset($attr['hint']))
    <p class="help is-success">{{ $attr['hint'] }}</p>
    @endif
</div>