<!DOCTYPE html>
<html lang="en">
    @include('core.auth.head')

    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div class="accountbg">
            
            <div class="content-center">
                <div class="content-desc-center">
                    <div class="container">
                        @yield('content')
                       
                    </div>
                </div>
            </div>
        </div>

    </body>
    @include('core.auth.js')
    
</html>