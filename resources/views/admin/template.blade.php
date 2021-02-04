@include('admin.partials.head')

<body class="sb-nav-fixed">

    @include('admin.partials.topbar')
    <div id="layoutSidenav">
        @include('admin.partials.sidenav')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    @include('admin.partials.messages')

                    @yield('content')
                </div>
            </main>
            @include('admin.partials.footer')
        </div>

    </div>
    @include('admin.partials.scripts')
