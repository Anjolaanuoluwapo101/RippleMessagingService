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
    @php
      echo session('key');
    @endphp
    <form action="{{ route('register') }}" method="post">
        @csrf
        <!-- Name -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label for="name">Name</label>
        </br>
        <input type="text" name="name" id="name" value="{{old('name')}}"/>
        </br>
        @error('name')
        <span>  {{$message}}  </span>
        @enderror
        
        <!-- Email-->
        </br><br>
        <label for="email">Email</label>
        </br>
        <input type="email" name="email" id="email" value="{{old('email')}}"/>
        </br>
        @error('email')
        <span>  {{$message}}  </span>
        @enderror
        
        <!-- Password -->
        </br></br>
        <label for="password">Password</label>
        </br>
        <input type="password" name="password" id="password"  value="{{old('password')}}"/>
        </br>
        @error('password')
        <span>gggg  {{$message}}  </span>
        @enderror
        
        <!-- Confirm password -->
        </br><br>
        <label for="password_confirmation">Confirm password</label>
        </br>
        <input type="password" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}"/>
        </br>
        @error('password_confirmation')
        <span>  {{$message}}  </span>
        @enderror
        
        <!-- Go to Login Page If already registered -->
        </br></br>
        <a href="{{route('login')}}"> Already have an account? Click here </a>
        
        <!-- Submit button -->
        </br></br>
        <button type="submit">Register</button>
    </form>
</body>
</html>