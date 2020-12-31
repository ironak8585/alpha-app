<div class="field">
    @if ($label)
    {{ Form::label($id, $label, ['class' => 'label']) }}
    @endif
    <div class="file is-info is-fullwidth has-name {{ $box ? 'is-boxed' : '' }}" id="{{ $id }}">
        <label class="file-label">
            <input class="file-input" type="file" name="{{ $name }}" accept="{{ $accept }}">
            <span class="file-cta">
                <span class="file-icon">
                    <i class="fas fa-upload"></i>
                </span>
                <span class="file-label">
                    {{ $placeholder }}...
                </span>
            </span>
            <span class="file-name"></span>
        </label>
    </div>
    <script>
        const fileInput = document.querySelector('#{{ $id }} input[type=file]');
        fileInput.onchange = () => {
          if (fileInput.files.length > 0) {
            const fileName = document.querySelector('#{{ $id }} .file-name');
            fileName.textContent = fileInput.files[0].name;
          }
        }
    </script>
</div>