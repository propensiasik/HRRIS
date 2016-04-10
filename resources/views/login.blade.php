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
  <section id="content" class="login">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h1>Human Resources Recruitment Information System</h1>
          <form action = {{url('/dologin')}} method="POST">

            <div class="form-inline">
              <div class="form-group">
                <label class="sr-only" for="exampleInputEmail3">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail3" placeholder="Enter email">
              </div>

              <div class="form-group">
                <label class="sr-only" for="exampleInputPassword3">Password</label>
                <input type="password" name ="password"class="form-control" id="exampleInputPassword3" placeholder="Password">
              </div>

              <button type="submit" class="btn btn-secondary">Login</button>
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </div>
            <?php 
              
              if(session_id()){
                echo'<h4>';
                echo $_SESSION['loginError'];
                echo'</h4>';
              }
              else{
                
              }
            ?>
            <div class="form-group">
              Haven't register yet? <a href="">Register here</a>
            </div>

            <div class="vertical-separator"></div>

            <div class="form-group">
              <button type="submit" class="btn btn-danger">Login via Google Account</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
  
</body>

</html>