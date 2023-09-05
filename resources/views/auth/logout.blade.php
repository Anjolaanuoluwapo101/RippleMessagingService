<!DOCTYPE html>
<html>
<head>
    <!-- Your head content here -->
</head>
<body>

<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>

</body>
</html>