<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Diet Plan System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(160deg, #f4fbf2 0%, #dcefd7 50%, #c7e4c4 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            background: #ffffff;
            padding: 44px 42px;
            border-radius: 22px;
            box-shadow: 0 22px 60px rgba(56, 96, 49, 0.18);
            width: 100%;
            max-width: 410px;
            border: 1px solid rgba(79, 138, 62, 0.08);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        h1 {
            text-align: center;
            font-size: 30px;
            font-weight: 700;
            color: #2f3f2f;
            margin-bottom: 12px;
        }

        .subtitle {
            text-align: center;
            color: #5c725d;
            margin-bottom: 32px;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #344734;
            font-weight: 600;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid rgba(79, 138, 62, 0.25);
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #4f8a3e;
            box-shadow: 0 0 0 3px rgba(79, 138, 62, 0.18);
        }

        .btn {
            width: 100%;
            padding: 14px;
            background-color: #4f8a3e;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 12px 24px rgba(79, 138, 62, 0.28);
        }

        .btn:hover {
            background-color: #3c6c2f;
            transform: translateY(-1px);
            box-shadow: 0 16px 32px rgba(61, 110, 47, 0.3);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background-color: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }

        .text-center {
            text-align: center;
            margin-top: 22px;
            font-size: 14px;
            color: #5c725d;
        }

        .text-center a {
            color: #4f8a3e;
            text-decoration: none;
            font-weight: 600;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
        
        <h1>Welcome Back</h1>
        <p class="subtitle">Login to your diet plan account</p>

        @if($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>

        <p class="text-center">
            Don't have an account? <a href="{{ route('register') }}">Sign up</a>
        </p>
    </div>
</body>
</html>
