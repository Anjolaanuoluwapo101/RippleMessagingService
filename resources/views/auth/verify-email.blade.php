<!DOCTYPE html>
<html>
<head>
    <title>Verify Email</title>
</head>
<body>
    <form action="{{ route('verification.request') }}" method="post">
      @csrf
      <button type="submit">Request a new link</button>
    </form>
    
    <h1>Verify email</h1>
    <p>Please verify your email address by clicking the link in the mail we just sent you. Thanks!</p>
</body>
</html>