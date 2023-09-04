<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <!-- Add any CSS or meta tags you need for styling and SEO here -->
</head>
<body>
    <h1>Register</h1>

    <form action="{{ route('register') }}" method="post">
        <!-- Name -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" />

        <!-- Email-->
        <label for="email">Email</label>
        <input type="email" name="email" id="email" />

        <!-- Password -->
        <label for="password">Password</label>
        <input type="password" name="password" id="password" />

        <!-- Confirm password -->
        <label for="password_confirmation">Confirm password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" />

        <!-- Submit button -->
        <button type="submit">Register</button>
    </form>
</body>
</html>