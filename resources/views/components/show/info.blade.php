<div class="box is-shadowless">
    <div class="level mb-3 is-mobile">
        <div class="level-left">
            <div class="level-item">
                <span class="icon is-small px-0">
                    @if ($icon)
                        {!! $icon !!}
                    @else
                    <i class="material-icons prefix">short_text</i>    
                    @endif                    
                </span>
            </div>           
            <div class="level-item">            
                <h6 class="subtitle is-6 has-text-grey ml-0 mb-0">        
                    {{ $label }}
                </h6>
            </div>
        </div>        
    </div>
    <p class="is-size-5 pl-5 ml-1 {{ $classes }}">
        {{ $value }}
    </p>
</div>