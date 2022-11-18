<script>
    var hostUrl = "assets/";
</script>
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>

<script src="{{ asset('js/config.js') }}"></script>
@error(config('util.SUCCESS'))
    <script>
        toastr.success("{{ $message }}");
    </script>
@enderror
@error(config('util.ERROR'))
    <script>
        toastr.error("{{ $message }}");
    </script>
@enderror
@if (session()->has(config('util.ERROR')))
    <script>
        toastr.error("{{ session()->get(config('util.ERROR')) }}");
    </script>
@endif
@if (session()->has(config('util.SUCCESS')))
    <script>
        toastr.success("{{ session()->get(config('util.SUCCESS')) }}");
    </script>
@endif
