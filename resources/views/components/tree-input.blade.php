<article class="box is-shadowless">
    <ul class="items" id="{{ $root }}">
        <li class="item ml-5 pl-3" style="display: none;" id="field">
            <div class="item-content">
                <div class="field has-addons">
                    <p class="control is-expanded">
                        <input name="{{ $name }}" class="input" type="text" placeholder="Field name">
                    </p>
                    <p class="control">
                        <button class="add-child button is-outlined is-info has-tooltip-left has-tooltip-info has-tooltip-arrow" data-tooltip="Add Child" type="button">
                            <span class="icon is-small">
                                <i class="fas fa-plus"></i>
                            </span>
                        </button>
                    </p>
                    <p class="control">
                        <button class="remove-self button is-outlined is-danger has-tooltip-right has-tooltip-danger has-tooltip-arrow" data-tooltip="Remove Self" type="button">
                            <span class="icon is-small">
                                <i class="fas fa-minus"></i>
                            </span>
                        </button>
                    </p>
                    @if ($summarize)
                    <p class="control px-3 my-2">
                        <label class="checkbox">
                            <input type="checkbox" name="summarize">
                            Total
                        </label>
                    </p>  
                    @endif
                </div>
                <ul class="items">
                </ul>
            </div>
        </li>
        <li class="item" id="fields">
            <div class="item-content">
                <div class="field has-addons">
                    <p class="control is-expanded">
                        <input name="{{ $name }}" class="input" type="text" value="Root" disabled>
                    </p>
                    <p class="control">
                        <button class="add-child button is-outlined is-info has-tooltip-left has-tooltip-info has-tooltip-arrow" data-tooltip="Add Child" type="button">
                            <span class="icon is-small">
                                <i class="fas fa-plus"></i>
                            </span>
                        </button>
                    </p>
                    @if ($summarize)
                    <p class="control px-3 my-2">
                        <label class="checkbox">
                            <input type="checkbox" name="summarize">
                            Total
                        </label>
                    </p>
                    @endif
                </div>
                <ul class="items" data-key="[]">
                </ul>
            </div>
        </li>
    </ul>
</article>
<script>
    $(document).ready(function(){
        const context = $('#{{ $root }}');
        const $field = $('#field', context);
        const summarize = Boolean('{{ $summarize }}');

        //do not submit on enter
        preventSubmitOnEnter(context.parents('form'));
                
        $('button.add-child').click(function(){            
            //create clone of node
            const $new = $field.clone(true);
            $new.removeAttr('id');            
            $new.show();

            //prepare name for field
            const $items = $(this).parent().parent().next();
            const parentKey = $items.data('key');
            let childKey = 1;
            if($items.children().length > 0){
                const $last = $items.children().last();
                const $lastItems = $('> div.item-content > ul.items', $last);
                childKey = Number($lastItems.data('index')) + 1;
            }
            //const childKey = $items.children().length + 1;            
            let key = parentKey + "[" + childKey + "]";

            //update container key
            const $childItems = $('> div.item-content > ul.items', $new);            
            $childItems.data('key', key);
            $childItems.data('index', childKey);

            //update key of parent item to preserve its value
            if($items.children().length == 0){
                let $currentInput = $('input[type=text]', $(this).parent().parent());
                const name = $currentInput.attr('name');
                $currentInput.attr('name', name + "[0]");

                if(summarize){
                    $currentSummarize = $('input[type=checkbox]', $(this).parent().parent());
                    const name = $currentSummarize.attr('name');
                    $currentSummarize.attr('name', name + "[0]");
                }                
            }

            //update name of new field
            let $input = $('> div.item-content > div.field > p.control > input[type=text]', $new);
            $input.attr('name', $input.attr('name') + key);
            $input.prop('required', true);

            //update name of summary field
            if(summarize){
                $input = $('> div.item-content > div.field > p.control > label.checkbox > input[type=checkbox]', $new);
                $input.attr('name', $input.attr('name') + key);
            }
            $items.append($new);
        });

        $('button.remove-self').click(function(){
            //get container
            const $item = $(this).parent().parent().parent().parent();
            const $items = $item.parent();            
            $item.remove();

            //update key of parent item to preserve its value
            if($items.children().length == 0){
                let $currentInput = $('input[type=text]', $items.prev());
                const name = $currentInput.attr('name');
                const lastIndex = name.lastIndexOf("[0]");
                if(lastIndex >= 0){
                    //is parent
                    if(name.length - lastIndex == 3){
                        const modifiedName = name.substr(0, name.length - 3);
                        $currentInput.attr('name', modifiedName);        
                    }
                }
                if(summarize){
                    $currentSummarize = $('input[type=checkbox]', $items.prev());
                    const name = $currentSummarize.attr('name');
                    const lastIndex = name.lastIndexOf("[0]");
                    if(lastIndex >= 0){
                        //is parent
                        if(name.length - lastIndex == 3){
                            const modifiedName = name.substr(0, name.length - 3);
                            $currentSummarize.attr('name', modifiedName);
                        }
                    }
                }                
            }
        });    
    });
</script>