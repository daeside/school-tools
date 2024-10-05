<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <title>{{ $pageName }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dataTables.css') }}" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/vue-demi.js') }}"></script>
    <script src="{{ asset('js/vue-core.js') }}"></script>
    <script src="{{ asset('js/validators.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
</head>
<script>
    const {
        createApp,
        reactive
    } = Vue;
    const {
        useVuelidate
    } = Vuelidate;
    const {
        required,
        minLength,
        maxLength
    } = VuelidateValidators;
</script>

<body class="text-center">
    @yield('content')
    @if(!$isAdmin)
    @endif
</body>

</html>