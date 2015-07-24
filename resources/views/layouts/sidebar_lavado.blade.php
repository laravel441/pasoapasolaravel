<!doctype html>
<html>
    <head>
        @include('includes.head')
    </head>
    <body style="padding-top: 50px">
        <header>
            @include('includes.header_lavado')
        </header>

        <div id="wrapper" >

            <!-- sidebar content -->
            <div id="sidebar-wrapper">
                @include('includes.sidebar')
            </div>

            <!-- main content -->                            
            <div id="page-content-wrapper">
                <a id="menu-toggle" href="#" class="glyphicon glyphicon-align-justify btn-menu toggle">
                            </a>

                <div class="container-fluid" >
                    <div class="row">
                        <div class="col-lg-12">
                            <!--a href="#menu-toggle" class="btn btn-default" id="menu-toggle">-</a-->
                             @yield('content')
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <footer>
                    @include('includes.footer_lavado')
        </footer>

        <!-- Menu Toggle Script -->
        <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        </script>


    </body>
</html>