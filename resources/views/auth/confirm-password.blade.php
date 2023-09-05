<!DOCTYPE html>
<html>
<head>
    <!-- Your head content here -->
</head>
<body>

<h1>Confirm Password</h1>

<form action="{{ route('password.confirm') }}" method="post">
    @csrf

    <!-- Password -->
    <label for="password">Password</label>
    <br>
    <input type="password" name="password" id="password" />
    
    <!-- Submit button -->
    <br>
    <button type="submit">Confirm Password</button>
</form>

</body>
</html>