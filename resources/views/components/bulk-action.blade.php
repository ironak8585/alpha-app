<div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('input[name=select_all]').click(function(){
                const context = $(this).parents('table');
                if($(this).is(":checked")){
                    $('input[name=record]', context).prop("checked", true).change();
                } else {
                    $('input[name=record]', context).prop("checked", false).change();
                }
            });
        });

        const getSelectedRecords = () => {
            let selected = [];
            const $table = $('#records-table');
            $('input[name=record]:checked', $table).each(function () {
                const id = $(this).data('id');
                selected.push(id);
            });
            return selected;
        };

        const submitForm = (action) => {
            const $form = $('#' + action);
            const selected = getSelectedRecords();
            if (selected.length === 0) {
                showMessage("Select at lease one record", 'error');
                event.preventDefault();
                return;
            }
            const ids = JSON.stringify(selected);
            $('input[name=ids]', $form).val(ids);
            $form.submit();
        };
    </script>
    @foreach ($actions as $action => $label)
    <div>
        {{ Form::open(['id' => $action, 'class' => 'bulk-form', 'method' => 'POST', 'route' => [$route . '.' . $action], 'class' => 'form-confirm'])}}
        {{ Form::hidden('ids', '') }}
        {{ Form::close() }}
    </div>
    @endforeach
    <div class="dropdown is-hoverable mr-3">
        <div class="dropdown-trigger">
            <button class="button is-primary" aria-haspopup="true" aria-controls="dropdown-menu">
                <span class="icon">
                    <i class="fas fa-tasks"></i>
                </span>
                <span class="icon is-small">
                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                </span>
            </button>
        </div>
        <div class="dropdown-menu" id="dropdown-menu" role="menu">
            <div class="dropdown-content">
                @foreach ($actions as $action => $label)
                <a class="dropdown-item" onclick="submitForm('{{ $action }}')">
                    {{ $label }}
                </a>
                @endforeach
            </div>
        </div>
    </div>    
</div>