<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title') - {{ config('app.name') }}</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" type="text/css" href="{{ asset('panel/css/main.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('panel/css/font-awesome/4.7.0/css/font-awesome.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('panel/summernote/summernote-bs4.css') }}">
        @trixassets
    </head>
    <body class="app sidebar-mini rtl">
        @include('panel.partials.header')
        @include('panel.partials.sidebar')
        <main class="app-content">
            @yield('content')
        </main>
        <script src="{{ asset('panel/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('panel/js/popper.min.js') }}"></script>
        <script src="{{ asset('panel/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('panel/js/main.js') }}"></script>
        <script src="{{ asset('panel/js/plugins/pace.min.js') }}"></script>
        <script src="{{ asset('panel/summernote/summernote-bs4.min.js') }}"></script>
        <script>
            $(function(){

                'use strict';
                // Inline editor
                var editor = new MediumEditor('.editable');
                // Summernote editor
                $('#summernote1').summernote({
                    height: 150,
                    tooltip: false
                })
            });
        </script>
    </body>
</html>
