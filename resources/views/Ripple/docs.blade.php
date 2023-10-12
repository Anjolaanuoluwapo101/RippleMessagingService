<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="{{ asset('css/styyyle.css') }}"> <!-- Assuming the CSS file is located in the public/css directory -->
 <link rel="stylesheet" href="{{ asset('css/w3.css') }}"> <!-- Assuming the CSS file is located in the public/css directory -->
 <title>Ripple - BECOME A RIPPLER TODAY </title>
 <style>
  .mySlides {
   display: none;
  }
 </style>
</head>
<body>
 <!-- shalaye portion -->
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
    <a href="{{ route('register') }}" target="__blank" class="button"><button class="w3-button w3-text-red">Register </button> </a>
   </div>
   <div class="form-group">
    <a href="{{ route('login') }}" target="__blank" class="button"> <button class="w3-button w3-text-blue"> Login </button> </a>
   </div>
  </div>
 </div>

 <p class="w3-center w3-bold">
  HOW IT WORKS:
 </p>
 <!-- accordion 1-->
 <button onclick="accordion('howItWorks1')" class="w3-button w3-block w3-center-align w3-border">
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
   <li> Once gotten,copy the URL and paste in the form in your dashboard page,then click submit/register <a target="__blank" href="{{route('dashboard').'#host_form'}}"> Click Here</a> </li>
   <img src="{{asset('imgs/register-url-form.png')}}" class="w3-round" style="width:80%" alt="register-form">
   <li> If it's successful,scroll down to check the registered-urls table.It would have been updated. <a target="__blank" href="{{route('dashboard').'#registered_urls'}}"> Click Here</a></li>
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
     <li>In the script section <span class="w3-opacity">(anywhere your website host allows you to add script for a particular page/content,it could even be in the <_body> tag of that post ) </span> add a JS Ajax code or any other related technology that helps you link your frontend to another source, you could employ the use of XMLHttpRequest,Fetch API,Socket.io,jQuery ajax etc. </li>
     <li> Copy the URL found under the `Retrieve Comments Link`column for the corresponding URL(post/content) whose messages(comments) you want to retrieve.Check the Registered URLs table for this in your the dashboard <a target="__blank" href="{{route('dashboard').'#registerd_urls'}}"> Check here </a> </li>
     <li> This copied url is what to use in the JS Ajax Request </li>
     <li> The JSON body will look like this .....</li>
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
      <li> The only difference is that,you will need to use the URL from the 'Retrieve Replies For A Comment' Column corresponding to the URL(post/content) where the comment was made,this is also found in the Registered URLs table <a target="__blank" href="{{route('dashboard').'#registerd_urls'}}"> Check here</a>  </li>
      <li> Now back at the post in your website,you simply have to write JavaScript logic(Ajax any related technology), then replace 'comment_id' in that link with the comment id in particular to get the a paginated JSON response that contains the replies to that comment.. </li>
      <li> Here's how a typical replies JSON body will look like: </li>
      <!-- JSON BODY -->
     </ul>
    </div>
   </div>
   <div class="w3-container">
    <p class="w3-text-large">
     SENDING COMMENTS AND REPLIES
    </p>
    <p>
     The below shows you how adding commenting and replying functionality
    </p>
    <div class="w3-content">
     <p>
      <b>To add commenting feature</b>
     </p>
     <ul>
      <li>Ensure you've have registered an account <a href="{{route('register')}}"> Register</a></li>
      <li>Copy the URL found under the `Send Comment/Reply Link`column for that corresponding URL(post/content).Check the Registered URLs table for this in your the dashboard
       <a target="__blank" href="{{route('dashboard').'#registered_urls'}}"> Dashboard</a> </li>
      <li>You may want to retrieve this link automatically via JS without having to manually copy it from your dashboard </li>
      <li> Now back at the post in your website,you simply have to write JavaScript logic(jQuery any related technology) that sends a post form to that link.The post form should contain the following:</li>
      <li>The <b>name</b> <pre> 'ripple_id' </pre> html attribute will be automatically added at the backend(don't worry about adding this) </li>
      <li>A message body with the html attribute <b>name</b> <pre> 'ripple_body' </pre></li>
      <li> For media files,the inputs should all have an html attribute <b>name</b> of <pre> 'files[]' </pre> </li>
      <li>When a message is sent,if successful a Json equivalent of the array is generated <pre> ["status"=>"success","message"=>"...saved" ] </pre>.. endeavor to use JS to send form so as to retrieve this JSON body </li>
      <li>If the message wasn't successfully sent,a JSON equivalent of the array is generated <pre>["status"=>"failure","message"=>"message not saved"]</pre></li>
     </ul>
    </ul>
    <br><br>
    <p>
     <b>To add replying feature</b>
    </p>
    <ul>
     <li>Follow step 1 and step 2 under 'To add a commenting feature'.Create a post form that contains the following </li>
     <li>An input tag with the <b>name</b> <pre>'ripple_reference_id'</pre> which should contain the id of the comment the post form is replying to.</li>
     <li>An input tag with the name <b>name</b> <pre>'rippler_reference_id'</pre> which should contain the id of the person who made the comment being replied </li>
     <li>A message body with the html attribute <b>name</b> <pre> 'ripple_body' </pre></li>
     <li>For media files,the inputs should all have an html attribute <b>name</b> of <pre> 'files[]' </pre> </li>
    </ul>
   </div>
  </div>


 </div>
 <!-- second accordion -->
 <button onclick="accordion('howItWorks2')" class="w3-button w3-block w3-center-align w3-border">
  FOR API USERS </button>
 <div id="howItWorks2" class="w3-container w3-hide">
  Documentation coming soon!
 </div>


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
  <button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
  <button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>
 </div>

 <div class="w3-container">
  <p>
   Ripple is an independent comment and reply system that can be easily be implemented on any website or web application
  </p>
  <ul class="w3-ul">
   <li>Blogs</li>
   <li>E Commerce Websites</li>
   <li>Journals</li>
   <li>Articles</li>
   <li>And So Much More!</li>
  </ul>

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