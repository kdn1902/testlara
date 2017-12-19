<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Тестовое задание</title>

    <!-- Bootstrap -->
    <link href="/css/app.css" rel="stylesheet">

    @yield('styles')	
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

 <nav class="navbar navbar-default">
   <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">Сотрудники</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-main">
      <ul class="nav navbar-nav">
        <li><a href="/">Дерево сотрудников</a></li>
        <li><a href="/employees">Список сотрудников</a></li>
        <li><a href="/">3</a></li>
        <li><a href="/">4</a></li>
        <li><a href="/">5</a></li>
      </ul>
      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
      <!-- Authentication Links -->
      @guest
             <li><a href="{{ route('login') }}">Login</a></li>
             <li><a href="{{ route('register') }}">Register</a></li>
      @else
             <li class="dropdown">
    	         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                         {{ Auth::user()->name }} <span class="caret"></span>
        	     </a>
             <ul class="dropdown-menu">
	             <li>
                          <a href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                  Logout
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                          </form>
                  </li>
             </ul>
             </li>
       @endguest
       </ul>
    </div>
  </div>
</nav>

   <div class="container-fluid">
            @yield('content')
   </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    @yield('scripts')
  </body>
</html>
