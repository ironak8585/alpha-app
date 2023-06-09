<div id='notification-container'>
    <!-- Render errors if any -->
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <script>
        showMessage('{{ $error }}', 'error');
    </script>
    @endforeach
    @endif
    @if (\Session::has('success'))
    <script>
        showMessage("{{ \Session::get('success') }}");
    </script>
    @endif
    @if (\Session::has('warning'))
    <script>
        showMessage("{{ \Session::get('warning') }}", 'warning');
    </script>
    @endif
</div>