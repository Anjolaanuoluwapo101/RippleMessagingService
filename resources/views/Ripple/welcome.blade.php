<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Assuming the CSS file is located in the public/css directory -->
  <title>Ripple - Become a Rippler Today</title>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1 class="logo"> <span>RIP</span><span>PLE</span></h1>
      <p class="slogan">
        Become a Rippler today
      </p>
    </div>
    <br><br>
    <div class="button-container">
      <div class="form-group">
        <button><a href="{{ route('ripple_register') }}" target="__blank"  class="button">Register</a></button>
      </div>
      <div class="form-group">
        <button><a href="{{ route('ripple_login') }}" target="__blank" class="button">Login</a></button>
      </div>
    </div>
  </div>
</body>
</html>