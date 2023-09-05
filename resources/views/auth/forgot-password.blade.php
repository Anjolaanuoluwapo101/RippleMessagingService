<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Form</title>
</head>
<body>
    <p>Please input your email to recieve password:</p>

        <!-- SRF Token -->
    <form action="/forgot-password" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Email Input -->
        <label for="email">Email:</label>
        </br>
        <input type="email" id="email" name="email" required>

        <!-- Submit Button -->
        <br></br>
        <button type="submit">Send Email</button>
    </form>
</body>
</html>