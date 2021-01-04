<nav class="level">
    <div class="level-left">
        <h1 class="title has-text-primary">{{ $property }}</h1>
    </div>
    <div class="level-right">
        {{ Form::open(['route' => $route . '.store', 'method' => 'POST']) }}
        <div class="field has-addons">
            <div class="control">
                <input name="name" class="input" type="text" placeholder="Enter name">
            </div>
            {{ Form::submit('Create', ['class' => 'button is-primary']) }}
        </div>
        {{ Form::close() }}
    </div>
</nav>
<x-tag-list :route="$route" :show="false" :actions="[]" :records="$records" title="name">
</x-tag-list>
