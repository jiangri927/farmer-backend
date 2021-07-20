<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            #bg{
                background: url({{asset('assets/media/bg/bg2.jpg')}}) center center no-repeat;
                height: 100%;
                background-size: cover;
                position:absolute;
                width:calc(100% + 500px);
            }
            #main{
                margin: 0;
                padding: 0;
                overflow: hidden;
            }
        </style>
    </head>
    <body id="main">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links" style="z-index:5;">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <section id="bg"></section>
            <div class="title m-b-md" style="z-index:10;">
                Sari
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript">
        $('#bg').mousemove(function(e){
            var moveX = (e.pageX * -1/12);
            var moveY = (e.pageY * -1/12);
            $(this).css('background-position', moveX + 'px ' + moveY + 'px');
        });
        </script>
    </body>
</html>
