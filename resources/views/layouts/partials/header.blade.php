<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--
            here you should use config() method instead of
            env() as when you make cache active it take all env information and
            if you want to make changes you should clear cache and active it again
    --}}
    <title>{{config('app.name')}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset("plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("dist/css/adminlte.min.css")}}">
    @stack('styles')

    @vite('resources/css/app.css')
    {{--

                                        <=> i want to preview something here <=>
    => if you want to add some links to head and you actually don't want from these files to be override
    => you can use @stack() and in you extend file use @push to put your links to avoid interrupting or something like that

    --}}
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
