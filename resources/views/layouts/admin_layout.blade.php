{{-- @php
    // session_start();
@endphp --}}
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>JO Request | @yield('title')</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="shortcut icon" type="image/png" href="">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <!-- CSS LINKS -->
            @include('shared.css_links.css_links')
            <style>
                .modal-xl-custom{
                    width: 95% !important;
                    min-width: 90% !important;
                }
            </style>
        </head>
        <body class="hold-transition sidebar-mini">
            <div class="wrapper">
                {{-- @if ($user_level_id == 1) --}}
                    @include('shared.pages.header')
                    @include('shared.pages.admin_nav')
                    @include('shared.pages.footer')
                {{-- @else --}}
                    {{-- @include('shared.pages.header')
                    @include('shared.pages.user_nav')
                    @include('shared.pages.footer') --}}
                {{-- @endif --}}

                <!-- Global Spinner -->
                <div class="modal fade" id="modalSpinner">
                    <div class="modal-dialog">
                        <div class="modal-content pt-3">
                            <p class="spinner-border spinner-border-xl text-center mx-auto"></p>
                            <p class="mx-auto">Logging out...</p>
                        </div>
                    </div>
                </div>

                @yield('content_page')
            </div>

            <!-- JS LINKS -->
            @include('shared.js_links.js_links')
            @yield('js_content')
            <script type="text/javascript">
                $(document).ready(function(){
                    function UserLogout(){
                        $.ajax({
                            url: "logout",
                            method: "get",
                            dataType: "json",
                            beforeSend: function(){

                            },
                            success: function(reponse){
                                if(reponse['result'] == 1){
                                    window.location = 'signin_page';
                                }
                                else{
                                    alert('Logout error!');
                                }
                            }
                        });
                    }

                    $("#btnLogout").click(function(event){
                        $('#modalLogout').modal('hide');
                        $('#modalSpinner').modal('show');
                        setTimeout(() => {
                            UserLogout();
                            console.log("Logging out...")
                        }, 400);
                        
                    });
                });
            </script>
        </body>
    </html>

