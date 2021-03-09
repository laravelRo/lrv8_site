@include('front.partials.head')

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                @include('front.partials.topbar')
                @include('admin.partials.messages')

                @yield('content')

            </div>
        </div>

        <!-- Sidebar -->
        @include('front.partials.side-bar')


    </div>
    @include('front.partials.scripts')
