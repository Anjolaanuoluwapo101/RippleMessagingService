<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8"/>
 <!--<meta name="_token" content="{!! csrf_token" />-->
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
 <title>Simple Form</title>
</head>
<body>
 <div id="messages">
  <h5>Messages:</h5>
 </div>
 <br><br>
 <!-- Send Message Form-->
 <form enctype="multipart/form-data" action="{{url('/send-ripple').'/JAoSeSzVdjKEId'}}" method="post">
  @csrf
  <label for="rippler_id">Rippler_ID:</label><span> The ID of the person sending message </span>
  <input type="text" id="rippler_id" name="rippler_id" value="{{auth()->user()->rippler_id}}" placeholder="Enter something...">
  <br>
  <br>
  <label for="ripple_reference_id">Recipient Message ID:</label><span>*If a user is sending replying a message then this should be filled with a message ID(the message being replied) </span>
  <input type="text" id="ripple_reference_id" name="ripple_reference_id" value="" placeholder="Enter something...">
  <br>
  <br>
  <label for="rippler_reference_id">Recipient ID:</label> <span>*This is the ID of the user who made the message of Message ID <span id="ripple_reference_id_span"> </span> </span>
  <input type="text" id="rippler_reference_id" name="rippler_reference_id"value="" placeholder="Enter something...">
  <br>
  <br>
  <label for="files">Media:</label> <span>*Can send as many files as possible</span>
  <input type="file" id="files" name="files[]" value="" placeholder="" multiple="multiple">
  <br>
  <br>
  <label for="ripple_body">Message:</label>
  <input type="text" id="ripple_body" name="ripple_body" placeholder="Enter something...">
  <br>
  <br>
  <input type="submit" value="Submit">
 </form>
 
 
 
 <script>
 
  const rippleReferenceID = document.getElementById('ripple_reference_id');
  rippleReferenceID.addEventListener('input', () => {
    document.getElementById('ripple_reference_id_span').textContent = rippleReferenceID.value; 
  });
  
  //to get comments on a post or a particular url
  var request = new XMLHttpRequest();
  request.open('GET',"{{url('get-ripples/JAoSeSzVdjKEId')}}", true);
  request.setRequestHeader('Content-Type', 'application/json');
  // Add any additional headers you need
  request.onreadystatechange = function() {
    if (request.readyState === 4) {
      if (request.status === 200) {
       var data = JSON.parse(request.responseText);
       let data_messages = data.data;
       data_messages.forEach(function(message){
        let messagesDiv = document.getElementById('messages');
        let messageDiv = 
        `
        <div>
        <h6>Message Body</h6>
        Sender Name:  <br/>
        Message Body: ${message.ripple_body} </br>
        Time Sent: ${message.created_at} </br>
        Number of Likes : ${message.ripple_likes_count}</br>
        Number of Replies : ${message.ripple_ripples_count} </br>
        <button onclick="getRelatedRipples('${message.ripple_id}')">Get Replies</button> </br>
        <!-- Replies to this message will be found in the div below -->
        <div id="replies_${message.ripple_id}">
        <h6>Replies:</h6>
        
        </div>
        </div>
        `;
        messagesDiv.innerHTML += messageDiv;
       });
      } else {
        // Handle any error that occurred during the request
        alert('Error:', request.status);
      }
    }
  };
  request.send();
  
  function getRelatedRipples(ripple_id){
   var link = "{{url('get-related-ripples/JAoSeSzVdjKEId/')}}" +"/"+ ripple_id;
   var request = new XMLHttpRequest();
   request.open('GET',link, true);
   request.setRequestHeader('Content-Type', 'application/json');
   // Add any additional headers you need
   request.onreadystatechange = function() {
     if (request.readyState === 4) {
       if (request.status === 200) {
        alert(JSON.stringify(request.responseText))
        var data = JSON.parse(request.responseText);
        let data_replies_to_messages = data.data;
        data_replies_to_messages.forEach(function(message){
         let repliesDiv = document.getElementById('replies_'+message.ripple_id);
         let replyDiv = 
         `
         <div>
         Sender Name: 
         Message Body: ${message.ripple_body} </br>
         Time Sent: ${message.created_at} </br>
         Number of Likes : ${message.ripple_likes_count}</br>
         Number of Replies : ${message.ripple_ripples_count} </br>
         </div>
         `;
         repliesDiv.innerHTML += replyDiv;
        });
       } else {
         // Handle any error that occurred during the request
         alert('Error:', request.status);
       }
     }
   };
   request.send();
  }
  
 </script>
</body>
</html>