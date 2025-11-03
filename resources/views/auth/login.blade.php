@extends('layouts.app')

@section('content')
<style>
    .login-container {
        display: flex;
        height: 100vh;
        width: 100%;
        font-family: 'Montserrat', sans-serif;
    }
    
    .login-left {
        flex: 1;
        background: #ffffff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 40px;
    }
    
    .login-right {
        flex: 1;
        background: linear-gradient(135deg, #6b1a1a 0%, #4a0e0e 100%);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 40px;
        color: white;
        border-top-left-radius: 50px;
        border-bottom-left-radius: 50px;
    }

    
    .logo-placeholder {
        width: 100px;
        height: 100px;
        background: #f0f0f0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        color: #999;
        text-align: center;
    }
    
    .welcome-title {
        font-size: 36px;
        font-weight: 600;
        margin-bottom: 25px;
        color: #333;
    }
    
    .welcome-subtitle {
        font-size: 14px;
        color: #666;
        margin-bottom: 50px;
    }
    
    .login-form {
        width: 100%;
        max-width: 350px;
    }
    
    .form-input {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
        transition: border-color 0.3s;
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #6b1a1a;
    }
    
    .form-input.is-invalid {
        border-color: #dc3545;
    }
    
    .invalid-feedback {
        color: #dc3545;
        font-size: 12px;
        margin-top: -15px;
        margin-bottom: 15px;
        display: block;
    }
    
    .forgot-password {
        font-size: 14px;
        color: #333;
        text-decoration: none;
        margin-bottom: 25px;
        display: inline-block;
    }
    
    .forgot-password:hover {
        text-decoration: underline;
        color: #6b1a1a;
    }
    
    .btn-signin {
        width: 100%;
        padding: 15px;
        background: #6b1a1a;
        color: white;
        border: none;
        border-radius: 15px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
    }
    
    .btn-signin:hover {
        background: #4a0e0e;
    }
    
    .right-logo-placeholder {
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        color: rgba(255, 255, 255, 0.5);
        text-align: center;
    }
    
    .system-title {
        font-size: 35px;
        font-weight: 700;
        letter-spacing: 2px;
        margin-bottom: 35px;
    }
    
    .system-subtitle {
        font-size: 35px;
        font-weight: 700;
        margin-top: -30px;
    }
    
    .signup-text {
        font-size: 22px;
        margin-bottom: 20px;
        font-weight: 300 !important;
        text-align: center;
    }
    
    .btn-signup {
        padding: 12px 60px;
        background: white;
        color: #6b1a1a;
        border: none;
        border-radius: 15px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-signup:hover {
        background: #f0f0f0;
        color: #6b1a1a;
        text-decoration: none;
    }
    
    @media (max-width: 768px) {
        .login-container {
            flex-direction: column;
        }
        
        .login-right {
            order: -1;
            min-height: 300px;
        }
        
        .system-title {
            font-size: 32px;
        }
        
        .system-subtitle {
            font-size: 20px;
        }
    }
</style>

<div class="login-container">
    <div class="login-left">
        <div class="logo-placeholder">
            <img src="{{asset('assets/images/marsu-logo.png')}}" alt="" height="120">
        </div>
        
        <h1 class="welcome-title">Welcome Back !!</h1>
        <p class="welcome-subtitle">Please enter your credentials to log in</p>
        
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf
            
            <input 
                id="email" 
                type="email" 
                class="form-input{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                name="email" 
                value="{{ old('email') }}" 
                placeholder="Username"
                required 
                autofocus
            >
            
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            
            <input 
                id="password" 
                type="password" 
                class="form-input{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                name="password" 
                placeholder="Password"
                required
            >
            
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            
            @if (Route::has('password.request'))
                <a class="forgot-password" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
            
            <button type="submit" class="btn-signin">
                SIGN IN
            </button>
        </form>
    </div>
    
    <div class="login-right">
        <div class="right-logo-placeholder">
            <img src="{{asset('assets/images/marsu-logo.png')}}" alt="" height="120">
        </div>
        
        <h2 class="system-title">MARSU</h2>
        <h3 class="system-subtitle">Library Management System</h3>
        
        <p class="signup-text">"Your premier digital library <br> for borrowing and reading <br> books"</p>
    </div>
</div>
@endsection