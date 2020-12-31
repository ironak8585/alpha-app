<div>
    <ul>
        @foreach ($items as $label => $value)
            <li class="my-3">
                <div class="level is-mobile">
                    <div class="level-left">
                        <p class="subtitle">{{ $label }}</p>
                    </div>
                    <div class="level-right">
                        <span class="tag is-medium {{ $color }}">{{ $value ?? '-' }}</span>
                    </div>
                </div>                
            </li>
        @endforeach
    </ul>
</div>