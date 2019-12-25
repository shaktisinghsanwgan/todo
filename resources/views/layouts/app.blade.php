@include('layouts.header')
<body>
    <div id="app">
        @guest
            @include('layouts.topbar')
        @else
            @include('layouts.leftBar')
        @endguest
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
    $(function() {
        // Sidebar toggle behavior
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar, #content').toggleClass('active');
        });
});
    </script>
</body>
</html>
