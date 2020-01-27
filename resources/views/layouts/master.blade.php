<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@if(View::hasSection('title'))
            @yield('title')                
        @else
            TPN Mobile
        @endif
    </title>

    <script>
        var url = "{{ url('/') }}";
    </script>

    @include('partials.styles')
    
</head>

<body>

    @include('partials.nav')

    @yield('content')    

    @include('partials.footer')

    @include('partials.scripts')

</body>

</html>