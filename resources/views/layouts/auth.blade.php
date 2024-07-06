{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (your head content) ... -->
    <title>@yield('title')</title>
    <!-- ... (your head content) ... -->
</head>
<body>
    <div class="main-wrapper">

        @if(Auth::check())
            @if(Auth::user()->role == 'admin')
                @include('admin.body.sidebar')
                <div class="page-wrapper">
                    @include('admin.body.header')
                    @yield('admin')
                    @include('admin.body.footer')
                </div>
            @elseif(Auth::user()->role == 'agent')
                @include('agent.body.sidebar')
                <div class="page-wrapper">
                    @include('agent.body.header')
                    @yield('agent')
                    @include('agent.body.footer')
                </div>
            @else
                <!-- Handle other roles here if needed -->
            @endif
        @endif

        <!-- core:js and other scripts -->
        <!-- ... (your script includes) ... -->
    </div>
</body>
</html> --}}
