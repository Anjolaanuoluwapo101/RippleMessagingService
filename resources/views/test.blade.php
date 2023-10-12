<!DOCTYPE html>
<html>
<head>
    <title>Simple Form</title>
</head>
<body>
    <form action="/send-ripple/l9fEQFZ83ie3Ar" method="post">
      @csrf 
        <label for="rippler_id">Rippler_ID:</label>
        <input type="number" id="rippler_id" name="rippler_id" value="{{auth()->user()->rippler_id}}" placeholder="Enter something...">
        <br>
        <label for="ripple_reference_id">Recipient Message ID:</label>
        <input type="number" id="ripple_reference_id" name="ripple_reference_id" value="" placeholder="Enter something...">
        <br>
        <br>
        <label for="rippler_reference_id">Recipient ID:</label>
        <input type="text" id="rippler_reference_id" name="rippler_reference_id"value="" placeholder="Enter something...">
        <br>
        <br>
        <label for="ripple_body">Input:</label>
        <input type="text" id="ripple_body" name="ripple_body" placeholder="Enter something...">
        <br>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>