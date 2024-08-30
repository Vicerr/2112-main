<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>21/12 Sign-in</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
      background-color: #fafafa;
      display: flex;
      min-height: 100dvh;
      justify-content: center;
      align-items: center;
      font-size: 12px;

    }

    .login-page {
      width: min(90%, 360px);
      padding: 1rem;
      border-radius: 4px;
      display: grid;
      background-color: #ffffff;
      text-align: center;
    }

    a {
      font-size: 14px;
    }

    input,
    button {
      width: 100%;
      padding: 1em;
      border: 0;
      background-color: #fdfdfd;
      font-size: 12px;


    }

    button {
      margin-top: 1rem;
      background-color: #024e82;
      color: white;
      cursor: pointer;
    }

    form {
      font-family: Arial, Helvetica, sans-serif;
      display: grid;
      gap: 8px;
      font-size: 12px;

    }

    input:focus {
      outline: 0;
    }

    .forgot-pass {
      display: block;
      margin-left: auto;
    }

    .login {
      text-align: center;
      margin-bottom: .5rem;
      font-size: 20px;
      font-weight: bold;
    }

    .google {
      display: block;
      background-color: #999;
      border-radius: 4px;
      padding: 1em;
      text-decoration: none;
      color: inherit;
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 1.5rem;
      font-size: 12px;

    }

    .icon {
      display: inline-block;
      width: 30px;
      height: 30px;
      background-color: red;
      border-radius: 50%;
    }
  </style>
</head>

<body>
  <div class="login-page">
    <span class="login">LOGIN</span>

    <form action="/auth/login" method="post">
      @csrf
      <label for="email" style="justify-self: start; margin: 10px 0px 0px 10px"><b>Email</b></label>
      <input type="text" name="email" placeholder="Enter your email" value="{{old('email')}}" required>
      @error('email')
        <small style="color:red; display:block; font-style:italic;">{{$message}}</small>
      @enderror

      <label for="password" style="justify-self: start; margin: 10px 0px 0px 10px"><b>Password</b></label>
      <input type="password" name="password" placeholder="Enter your password" value="{{old('password')}}" required>
      @error('password')
        <small style="color:red; display:block; font-style:italic;">{{$message}}</small>
      @enderror
      <a class="forgot-pass" href="">forgot password?</a>
      <button type="submit">Login</button>
    </form>
    <br>
    <p>Don't have an account? <a href="{{ route('register') }}">Click here</a> to register.</p>
  </div>

  <br>

</body>
</html>