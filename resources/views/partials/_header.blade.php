<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>{{ $pageName }}</title>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}" />
            <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
            <script src="{{ asset('js/materialize.min.js') }}"></script>
            <script src="{{ asset('js/init.js') }}"></script>
        </head>
    <body>