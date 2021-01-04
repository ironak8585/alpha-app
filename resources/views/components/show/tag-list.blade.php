<div class="columns is-multiline">
    @foreach ($records as $record)
        <div class="column is-3">
            <div class="box">
                <h4 class="title is-4">{{ $record->$title }}</h4>
                @isset($subtitle)
                    <h6 class="subtitle is-6 mb-3">
                        {{ $record->$subtitle }}
                    </h6>
                @endisset
                <div class="field is-grouped is-justify-content-flex-end">
                    @if ($show)
                        <div class="control">
                            <a class="button is-info is-inverted is-borderless"
                                href="{{ route($routePrefix . '.show', $record->id) }}">
                                <i class="fas fa-info is-small"></i>
                            </a>
                        </div>
                    @endif

                    @if ($edit)
                        <div class="control">
                            <a class="button is-info is-inverted is-borderless"
                                href="{{ route($routePrefix . '.edit', $record->id) }}">
                                <i class="fas fa-edit is-small"></i>
                            </a>
                        </div>
                    @endif

                    @if ($delete)
                        <div class="control">
                            {{ Form::open(['method' => 'delete', 'route' => [$routePrefix . '.destroy', $record->id], 'class' => 'form-confirm']) }}
                            <button type="submit" class="button is-danger is-inverted is-borderless">
                                <i class="fas fa-trash-alt is-small"></i>
                            </button>
                            {{ Form::close() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
