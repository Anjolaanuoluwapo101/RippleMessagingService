<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>
<body>
    <h1>Login</h1>

    <form action="/reset-password" method="POST">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Email Input -->
        <label for="email">Email:</label>
        <br>
        <input type="email" id="email" name="email" required>

        <!-- Password Input -->
        <br></br>
        <label for="password">Password:</label>
        <br>
        <input type="password" id="password" name="password" required>
      
        <!-- Confirm password -->
        </br></br>
        <label for="password_confirmation">Confirm password</label>
        </br>
        <input type="password" name="password_confirmation" id="password_confirmation" />
 
        <!-- Hidden Token Input -->
        <input type="hidden" name="token" value="{{$token}}">

        <!-- Submit Button -->
        <br></br>
        <button type="submit">Login</button>
    </form>
</body>
</html>