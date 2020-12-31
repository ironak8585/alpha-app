<div class="field">
    @if ($label)
        {{ Form::label($id, $label, ['class' => 'label']) }}    
    @endif
    <div class="control">
        {{ Form::date($name, $value, $attr) }}
    </div>
    @if (isset($attr['hint']))
    <p class="help is-success">{{ $attr['hint'] }}</p>
    @endif
</div>