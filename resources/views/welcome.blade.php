<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ app('system')->companyName }}</title> 

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dfb-welcome.css') }}">

        <style>
            html, body {
                background-color: #fff;
                /*color: #636b6f;*/
                color: #0B110E;
                font-family: 'Raleway', sans-serif;
                font-weight: 400;
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
                /*color: #636b6f;*/
                color:  white;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            p.intro-text {
                color:  white;
                font-weight: 600;
            }

            .intro .title {
                color:  white;
                font-weight: 600;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        {{--  <div class="flex-center position-ref full-height">  --}}
        <div>    
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
            

            <div class="content">

                <section class="intro" style="padding-top: 100px;'>
                    <div class="intro-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    {{--  <h3 class="brand-heading" id="growMenuHomeCompanyNameII">dfbiii</h3>  --}}
                                    <div class="title m-b-md">
                                        {{ app('system')->companyName }}
                                    </div>
                                    <p class="intro-text">Your plant tracking solution to help manage your growing activities from germination to harvest and more.
                                    <br>Created by dfbiii solutions.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

                <section id="about" class="container content-section text-center notLoggedOn">
                    <div class="row">
                        
                        <div class="container text-center">
                            <h3>About</h3><br>
                            <div class="row">
                                <p align="center">This site help keep track of you plants and you can shre them with you friends on the community tab.</p>
                                <p align="center">Please direct any questions to <a href="mailto:support@dfbiii.com">support@dfbiii.com</a></p>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="features" class="container content-section">
                    <div class="row">
                        <div class="container text-center">
                            <h3>Features</h3><br>
                            <div class="row">
                                <div class="col-sm-3" >
                                    <img src="img/growScreenShot.png" class="img-responsive" style="width:100%" alt="Image">
                                    <p>Track each of your individual plants independently</p>
                                </div>
                                <div class="col-sm-3" >
                                    <img src="img/roomScreenShot.png" class="img-responsive" style="width:100%" alt="Image">
                                    <p>Track the rooms your plants are in</p>                                    </div>
                                <div class="col-sm-3" >
                                        <img src="img/userScreenShot.png" class="img-responsive" style="width:100%" alt="Image">
                                        <p>Ability to add multiple users</p>

                                </div>
                                <div class="col-sm-3" >
                                    <div class="well">
                                        <table>
                                            <tr>
                                                <td>
                                                    <img src="img/seedling.jpg" class="img-responsive center-block" style="width:100%" alt="Image">
                                                </td>
                                                <td>
                                                    <p>Ability to setup the detail for all of your plant types</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="well">
                                        <table>
                                            <tr>
                                                <td>
                                                    <img src="img/door.jpg" class="img-responsive center-block" style="width:50%" alt="Image">
                                                    </td>
                                                <td>
                                                    <p>Ability to setup the detail for all of your grow rooms</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="container">
                            <div style="float: left; width: 50%;">
                                <ul >
                                    <li>Manage your plant growing activities</li>
                                    <li>Manage by individual plant or by batch</li>
                                    <li>Manage your rooms, plant types, user and tasks</li>
                                    <li>Edit plant data quickly and easily</li>
                                    <li>Keep notes and photos to your plants</li>
                                    <li>Keep notes on users, rooms, plant types - everything!</li>
                                </ul>
                            </div>			
                            <div style="float: right; width: 50%;">
                                <ul >
                                    <li>Track Expenses</li>
                                    <li>Capture room environment data</li>
                                    <li>Tablet Friendly</li>
                                    <li>Customize site name and logo</li>
                                    <li>Always improving</li>
                                    <li>Support by email</li>
                                </ul>	
                            </div>			
                        </div>
                    </div>

                </section>

                <section id="contact" class="container content-section text-center" style="padding-bottom: 100px;>
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <h2>Contact</h2>
                            <p><a href="mailto:support@dfbiii.com">support@dfbiii.com</a></p>
                        </div>
                    </div>
                </section>
    
        </div>

        <nav class="navbar navbar-default navbar-fixed-bottom navbar-custom myFooter">
                <!--   <div class="container"> -->
                    @copywrite dfbiii.com - All Rights Reserved
                <!--   </div> -->
        </nav>
    </body>
</html>
