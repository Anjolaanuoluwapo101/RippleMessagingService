<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <form action="{{ route('login') }}" method="post">
        @csrf

        <!-- Email -->
        <label for="email">Email</label>
        </br>
        <input type="email" name="email" id="email" />

        <!-- Password -->
        </br>
        <label for="password">Password</label>
        </br>
        <input type="password" name="password" id="password" />
        
        <!-- automatic remember me set to false -->
        <input type="hidden" name="remember" id="remember" value=false />
        
        <!-- Submit button -->
        </br>
        <button type="submit">Login</button>
    </form>
</body>
</html>