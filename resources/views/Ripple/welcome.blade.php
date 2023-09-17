<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/styyyle.css') }}"> <!-- Assuming the CSS file is located in the public/css directory -->
  <link rel="stylesheet" href="{{ asset('css/w3.css') }}"> <!-- Assuming the CSS file is located in the public/css directory -->
  <title>Ripple - Become a Rippler Today</title>
  <style>
    .mySlides {
      display: none;
    }
  </style>
</head>
<body>
  <!-- shalaye portion -->

  <div class="w3-content w3-display-container">

    <div class="w3-display-container mySlides">
      <img src="{{asset('imgs/speed.png')}}" style="width:100%">
      <div class="w3-display-bottomleft w3-large w3-container w3-padding-16 w3-black">
        SPEED!
      </div>
    </div>

    <div class="w3-display-container mySlides">
      <img src="{{asset('imgs/flexible.png')}}" style="width:100%">
      <div class="w3-display-bottomright w3-large w3-container w3-padding-16 w3-black">
        FLEXIBLE!!
      </div>
    </div>

    <div class="w3-display-container mySlides">
      <img src="{{asset('imgs/secure.png')}}" style="width:100%">
      <div class="w3-display-topleft w3-large w3-container w3-padding-16 w3-black">
        SECURE!!!
      </div>
    </div>

    <!--
                                    <div class="w3-display-container mySlides">
                                      <img src="img_forest.jpg" style="width:100%">
                                      <div class="w3-display-topright w3-large w3-container w3-padding-16 w3-black">
                                        The Rain Forest
                                      </div>
                                    </div>

                                    <div class="w3-display-container mySlides">
                                      <img src="img_mountains.jpg" style="width:100%">
                                      <div class="w3-display-middle w3-large w3-container w3-padding-16 w3-black">
                                        Mountains!
                                      </div>
                                    </div>-->
    <button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
    <button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>
  </div>

  <div class="w3-container">
    <p>
      Ripple is a independent comment and reply system that can be easily be implemented on any website or web application
    </p>
    <ul class="w3-ul w3-border">
      <li>Blogs</li>
      <li>E Commerce Websites</li>
      <li></li>
    </ul>
    <p>
      HOW IT WORKS:
    </p>
    <!-- accordion 1-->
    <button onclick="accordion('howItWorks1')" class="w3-button w3-block w3-left-align">
      <span class="w3-text-bold"> FOR NORMAL WEBSITE ADMINS </span> </button>
    <div id="howItWorks1" class="w3-container w3-hide">
      <br>
      <div>
        Note: This is for the actual owners of the website not the guests that visit to view the website content
      </div>
      <ul>
        <li> Head over to <a href="{{route('register')}}" class="-">Registration page</a> and create an account, it's completely stress free. </li>
        <li> Get the URL(web address) that points directly to portion/post/content on your website.
          <span class="w3-opacity w3-italic"> www.example.com/path/to/exact/content</span> </li>
        <li> Once gotten,copy the URL and paste in the form in your dashboard page.Check below: </li>
        <img src="{{asset('imgs/register-url-form.png')}}" class="w3-round" style="width:80%" alt="register-form">
        <li> If it's successful,scroll down to check the registered-urls table.It would have been updated. </li>
        <img src="{{asset('imgs/registered-urls-table.png')}}" class="w3-round" style="width:80%" alt="registered-urls-table">
      </ul>
      <div class="w3-container">
        <p class="w3-text-large">
          GETTING COMMENTS
        </p>
        <p>
          The below shows you how to retrieve all users messages for a particular URL(post/content) you initially registered
        </p>
        <div class="w3-content">
          <ul>
            <li> It requires you editing and adding this simple bits of JavaScript Code to the post in particular </li>
            <li>In the script section <span class="w3-opacity">(anywhere your website host allows you to add script for a particular page/content,it could even be in the <_body> tag of that post ) </span>
              add a JS Ajax code that helps you link your frontend to another source, you could employ the use of XMLHttpRequest,Fetch API,Socket.io,jQuery ajax etc. </li>
              <li> Copy the URL found under the `Retrieve Comments Link`column for the corresponding URL(post/content) whose messages(comments) you want to retrieve.Check the Registered URLs table for this in your the dashboard
                <a href="{{route('dashboard')}}"> Dashboard</a> </li>
              <li> This copied url is what to use in the JS Ajax Request </li>
              <li> The output will look like this .....
                <!-- display JSOn body -->
              </ul>
            </div>
          </div>
          <div class="w3-container">
            <p class="w3-text-large">
              GETTING REPLIES TO A COMMENT
            </p>
            <p>
              The below shows you how to get/display replies for a particular comment
            </p>
            <div class="w3-content">
              <ul>
                <li>  <span class="w3-text-red">Steps is completely synonymous to that under 'GETTING COMMENTS' just above </span> </li>
                <li> The only difference is that,you will need to use the URL from the 'Retrieve Replies For A Comment' Column corresponding to the URL(post/content) where the comment was made,this is also found in the Registered URLs table </li>
                <li> Now back at the post in your website,you simply have to write JavaScript logic that replaces 'comment_id' in that link to get the a paginated JSON response that contains the replies to that comment.. </li>
                <li> Here's how a typical replies JSON body will look like: </li>
                <!-- JSON BODY -->
              </ul>
            </div>
          </div>
          <div class="w3-container">
            <p class="w3-text-large">
              SENDING COMMENTS
            </p>
            <p>
              The below shows you how adding commenting and replying functionality
            </p>
            <div class="w3-content">
              <p> To add commenting feature </p>
              <ul>
               <li></li>
               <li></li>
               <li></li>
              </ul>
            </div>
          </div>


        </div>
        <!-- second accordion -->
        <button onclick="accordion('howItWorks2')" class="w3-button w3-block w3-left-align">
          FOR NORMAL </button>
        <div id="howItWorks2" class="w3-container w3-hide">

        </div>
      </div>
      <!-- Sign Up Portion -->
      <div class="w3-container w3-center">
        <div class="header">
          <h1 class="w3-text-red"> <span>RIP</span><span class="w3-text-blue">PLE</span></h1>
          <p class="slogan">
            Become a Rippler today
          </p>
        </div>
        <br><br>
        <div class="">
          <div class="form-group">
            <button class="w3-button"><a href="{{ route('register') }}" target="__blank" class="button">Register</a></button>
          </div>
          <div class="form-group">
            <button class="w3-button"><a href="{{ route('login') }}" target="__blank" class="button">Login</a></button>
          </div>
        </div>
      </div>
      <script>
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
          showDivs(slideIndex += n);
        }

        function showDivs(n) {
          var i;
          var x = document.getElementsByClassName("mySlides");
          if (n > x.length) {
            slideIndex = 1
          }
          if (n < 1) {
            slideIndex = x.length
          }
          for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
          }
          x[slideIndex-1].style.display = "block";
        }


        function accordion(id) {
          var x = document.getElementById(id);
          if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
          } else {
            x.className = x.className.replace(" w3-show", "");
          }
        }
      </script>
    </body>
  </html>