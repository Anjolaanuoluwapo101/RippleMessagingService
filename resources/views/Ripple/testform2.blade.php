<!DOCTYPE html>
<html>
<head>
    <title>File Upload Form</title>
</head>
<body>
    <form action="/send-ripple" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Input field 1 -->
        <input type="file" name="files[]" multiple>
        <br><br>
        
        <!-- Input field 2 -->
        <input type="file" name="files[]" multiple>
        <br><br>
        
        <!-- Input field 3 -->
        <input type="file" name="files[]" multiple>
        <br><br>
        
        <!-- Input field 7 -->
        <label>Rippler ID</label> </br>
        <input type="text" name="rippler_id" value=111>
        <br><br>
        
        <!-- Input field 7 -->
        <input type="text" name="rippler_email" value="vhj@gmail.com">
        <br><br>
        
  
        
        <!-- Input field 5 -->
        <input type="text" name="rippler_reference_id" value=222 >
        <br><br>
        
        <!-- Input field 5 -->
        <input type="text" name="ripple_reference_id" value=2222 >
        <br><br>
        
        <!-- Input field 6 -->
        <input type="text" name="ripple_body" value="I'm a message replying the other message">
        <br><br>
        
        
        <!-- Submit button -->
        <input type="submit" value="Upload Files">
    </form>
</body>
</html>