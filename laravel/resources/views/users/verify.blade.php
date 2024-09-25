<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>21/12 | Verify Email</title>
  <link rel="icon" href="{{ asset('images/kaiadmin/favicon.ico') }}" type="image/x-icon" />
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Email Verification</div>
    
                    <div class="card-body">   
    
                        <p>Please check your email for a verification link.</p>
                        <p>If you haven't received the email, you can <a href="{{ route('verification.send') }}">request a new one</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <br>

</body>
</html>