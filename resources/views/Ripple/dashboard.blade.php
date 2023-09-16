<?php
//prevent unverified users from accessing
if (!auth()->check()) {
  abort(404);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>W3.CSS Template</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/w3.css')}}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body,h1,h2,h3,h4,h5,h6 {
      font-family: "Lato", sans-serif
    }
    .w3-bar,h1,button {
      font-family: "Montserrat", sans-serif
    }
    .fa-anchor,.fa-coffee {
      font-size: 200px
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="w3-top">
    <div class="w3-bar w3-red w3-card w3-left-align w3-large">
      <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
      <a href="#" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 1</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 2</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 3</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 4</a>
    </div>

    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
      <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
      <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
      <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
      <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 4</a>
    </div>
  </div>

  <!-- Header -->
  <header class="w3-container w3-red w3-center" style="padding:128px 16px">
    <h1 class="w3-margin w3-jumbo">START PAGE</h1>
    <p class="w3-xlarge">
      Template by w3.css
    </p>
    <button class="w3-button w3-black w3-padding-large w3-large w3-margin-top">Get Started</button>
  </header>

  <!-- First Grid -->
  <div class="w3-row-padding w3-padding-64 w3-container">
    <a id="form"> </a>
    <div class="w3-content">
      <div class="w3-twothird">
        <h1>Register URL for Ripple Service</h1>
        <form action="/add-url" class="w3-container" method="post">
          @csrf
          <label class="w3-text">URL</label>
          <input class="w3-input w3-border" type="text" name="url" placeholder="E.g 'www.example.com/my-post' " value="{{old('url')}}">
          <br>
          @error('url')
          <span class="w3-text-tiny w3-text-red">* {{$message}}</span>
          @enderror
        </br>
          <label class="w3-text">Your Password</label>
          <input class="w3-input w3-border" name="password" type="password">
          <br>
          @error('password')
          <span class="w3-text-tiny w3-text-red">* {{$message}}</span>
          @enderror
          <br>
          <button class="w3-btn" type="submit">Register</button>
          <br>
          @if (request()->session()->has('url_added'))
          <div class="w3-panel w3-round-xlarge w3-padding-64">
            URL has been added
          </div>
          @endif
        </form>
      </div>

      <div class="w3-third w3-center">
        <i class="fa fa-anchor w3-padding-64 w3-text-red"></i>
      </div>
    </div>
  </div>

  <!-- Second Grid -->
  <div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
    <div class="w3-content">
      <div class="w3-third w3-center">
        <i class="fa fa-coffee w3-padding-64 w3-text-red w3-margin-right"></i>
      </div>
      <table class="w3-table-all w3-small w3-hoverable" id="table_of_urls">
        <thead>
          <tr class="w3-light-grey">
            <th> Your Registered Urls </th>
          </tr>
        </thead>
        <!-- JavaScript code will populate this portion....-->
      </table>
    </div>
  </div>

  <div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">Quote of the day: live life</h1>
  </div>

  <!-- Footer -->
  <footer class="w3-container w3-padding-64 w3-center w3-opacity">
    <div class="w3-xlarge w3-padding-32">
      <i class="fa fa-facebook-official w3-hover-opacity"></i>
      <i class="fa fa-instagram w3-hover-opacity"></i>
      <i class="fa fa-snapchat w3-hover-opacity"></i>
      <i class="fa fa-pinterest-p w3-hover-opacity"></i>
      <i class="fa fa-twitter w3-hover-opacity"></i>
      <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>
    <p>
      Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a>
    </p>
  </footer>

  <script>
    // Used to toggle the menu on small screens when clicking on the menu button
    function myFunction() {
      var x = document.getElementById("navDemo");
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
      } else {
        x.className = x.className.replace(" w3-show", "");
      }
    }


  </script>

  <script>
    // Check if there's a fragment identifier in the URL
    if (window.location.hash) {
      // Get the fragment identifier (excluding the # symbol)
      var fragment = window.location.hash.substring(1);
      // Find the element with the corresponding id
      var targetElement = document.getElementById(fragment);
      // Scroll to the target element smoothly
      if (targetElement) {
        targetElement.scrollIntoView({
          behavior: 'smooth'
        });
      }
    }

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    // Get User registered URLs
    var url = '/load-urls';
    // Configure the request
    xhr.open('GET', url, true);
    // Set up an event handler for when the request is completed
    xhr.onload = function() {
      if (xhr.status === 200) {
        // Request was successful
        var urls = JSON.parse(xhr.responseText);
        // Get the table body element
        const tableBody = document.getElementById('table_of_urls');
        // Loop through the URLs and create a new row for each
        urls.forEach((url) => {
          // Create a new table row
          const newRow = document.createElement('tr');
          // Create a table cell for the URL
          const urlCell = document.createElement('td');
          urlCell.textContent = url;
          // Append the URL cell to the row
          newRow.appendChild(urlCell);
          // Append the new row to the table body
          tableBody.appendChild(newRow);
        });
      } else {
        // Request encountered an error
        alert('Request error:', xhr.statusText);
      }
    };

    // Set up an event handler for network errors
    xhr.onerror = function() {
      alert('Network error occurred.');
    };

    // Send the GET request
    xhr.send();

  </script>
</body>
</html>