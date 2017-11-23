<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/css/app.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.4/jstree.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.4/themes/default/style.min.css" />-->
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
        <li><a href="/">1</a></li>
        <li><a href="/">2</a></li>
        <li><a href="/">3</a></li>
        <li><a href="/">4</a></li>
        <li><a href="/">5</a></li>
      </ul>
    </div>
  </div>
</nav>

   <div class="container">
            @yield('content')
   </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    @yield('scripts')
  </body>
</html>
