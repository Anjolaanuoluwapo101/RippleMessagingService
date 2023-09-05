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
        @csrf
        <!-- Name -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label for="name">Name</label>
        </br>
        <input type="text" name="name" id="name" />

        <!-- Email-->
        </br>
        <label for="email">Email</label>
        </br>
        <input type="email" name="email" id="email" />

        <!-- Password -->
        </br>
        <label for="password">Password</label>
        </br>
        <input type="password" name="password" id="password" />

        <!-- Confirm password -->
        </br>
        <label for="password_confirmation">Confirm password</label>
        </br>
        <input type="password" name="password_confirmation" id="password_confirmation" />
        
        <!-- Go to Login Page If already registered -->
        </br>
        <a href="{{route('login')}}"> Already have an account? Click here </a>
        
        <!-- Submit button -->
        </br>
        <button type="submit">Register</button>
    </form>
</body>
</html>