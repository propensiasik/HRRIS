<style>
.column-left{ float: left; width: 30%; }
.column-right{ float: left; width: 30%; }
.column-center{ float: left; width: 30%; }
</style>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>HRRIS | Home</title>
  <meta name="description" content="UI Kit.">
  <meta name="author" content="Faizal Rahman">

  <link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
  <link rel="manifest" href="img/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />

  <!-- Fonts -->
  <link rel="stylesheet" href="fonts/font-text/fonts.css">

  <!-- CSS Bootstrap -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.css">

  <!-- CSS Component -->
  <link rel="stylesheet" href="css/component.css">

</head>

<body>

  <header>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">
            <img class="icon-menu" src="img/Logo.png">
          </a>
          <a class="navbar-brand title" href="{{url('recruiter')}}" {{$page == 'recruiter' ? 'class=active' : ''}}>
            HRRIS
          </a>
        </div>
		
		

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		 
		<ul class="nav navbar-nav navbar-right">
            <li>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <img class="icon-menu" src="img/Icon - User.png">
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{url('')}}" {{$page == 'login' ? 'class=active' : ''}}>Logout</a></li>
              </ul>
            </li>
          </ul> 

        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

<section id="content">

<center>
<div class="container">
   <div class="column-left">
		<div class="well">
			<a href = "{{url('applicants')}}" {{$page == 'applicants' ? 'class=active' : ''}}>
					<img src="img/applicant.png" style="width:50%">
					<h2> Applicants </h2>
			</a>	
		</div>
	</div>
	
	<div class="column-center">
		<div class="well">
			<a href="{{url('schedule')}}" {{$page == 'schedule' ? 'class=active' : ''}}>
				<img src="img/schedule.png" style="width:50%">
				<h2>Schedule </h2>
			</a>
		</div>
	</div>
   
	<div class="column-right">
		<div class="well">
			<a href="{{url('statistic')}}" {{$page == 'statistic' ? 'class=active' : ''}}>
				<img src="img/statistics.png" style="width:50%">
				<h2>Statistic</h2></div></div>
			</a>
		</div>
	</div>
	
</div>
</center>
	
</section>	  

<footer>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 copyright">
          All Right Reserved © Saka Digital, PT Saka Digital Arsana
        </div>
        <div class="col-md-6">
          <ul class="menu list-inline">
            <li><a href="">About</a></li>
            <li><a href="">Terms &amp; Conditions</a></li>
            <li><a href="">Privacy Policy</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  
  <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/bootstrap-select.js"></script>
  <script type="text/javascript" src="js/bootstrap-slider.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.file-input.js"></script>
  <script type="text/javascript" src="js/moment-with-locales.js"></script>
  <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
</body>
</html>