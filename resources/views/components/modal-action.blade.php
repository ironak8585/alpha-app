<div class="modal-container">
    <div class="control">
        <button class="button is-info is-inverted open-modal" data-target="{{ $id }}">
            <i class="fas fa-edit is-small"></i>
        </button>
    </div>
    <div class="modal" id="{{ $id }}">
        <div class="modal-background close-modal"></div>
        {{ Form::model($record, ['route' => $route, 'method' => 'PATCH']) }}
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title has-text-info">{{ $title }}</p>
                <button class="delete close-modal" aria-label="close" type="button"></button>
            </header>
            <section class="modal-card-body">
                @foreach ($fields as $name => $type)
                    @switch($type)
                        @case('text')
                            <x-text :name="$name"></x-text>
                            @break
                        @case('number')
                            <x-number :name="$name"></x-text>
                            @break
                        @default  
                            <x-text :name="$name"></x-text>                          
                    @endswitch
                @endforeach
            </section>
            <footer class="modal-card-foot">
                {{ Form::submit('Save', ['class' => 'button is-primary']) }}
                <button class="button is-primary is-outlined close-modal" type="button">Cancel</button>
            </footer>
        </div>
       {{ Form::close() }}
    </div>
</div>