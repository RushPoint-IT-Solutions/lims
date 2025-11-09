@extends('layouts.app')

@section('content')
<style>
    .otp-container {
        display: flex;
        height: 100vh;
        width: 100%;
        font-family: 'Montserrat', sans-serif;
        position: relative;
    }
    
    .back-button {
        position: absolute;
        top: 30px;
        left: 0;
        padding: 10px 30px;
        background: white;
        color: #6b1a1a;
        border: 2px solid #6b1a1a;
        border-left: none;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        z-index: 10;
        border-bottom-right-radius: 20px;
        border-top-right-radius: 20px;
    }

    .back-button:hover {
        background: #6b1a1a;
        color: white;
        text-decoration: none;
    }
    
    .otp-left {
        flex: 1;
        background: #ffffff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 40px;
    }
    
    .otp-right {
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
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        color: #999;
        text-align: center;
    }
    
    .system-title {
        font-size: 36px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
    }
    
    .system-subtitle {
        font-size: 35px;
        font-weight: 700;
        margin-top: -30px;
        color: #333;
    }
    
    .otp-instruction {
        font-size: 14px;
        color: #666;
        margin-bottom: 30px;
    }
    
    .otp-form {
        width: 100%;
        max-width: 350px;
    }
    
    .form-input {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 25px;
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
        margin-top: -20px;
        margin-bottom: 15px;
        display: block;
    }
    
    .btn-verify {
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
        text-transform: uppercase;
        font-family: 'Montserrat', sans-serif;
    }
    
    .btn-verify:hover {
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
    
    .right-title {
        font-size: 32px;
        font-weight: 700;
        letter-spacing: 2px;
        margin-bottom: 25px;
    }
    
    .right-subtitle {
        font-size: 32px;
        font-weight: 700;
        margin-top: -20px;
    }
    
    .tagline {
        font-size: 20px;
        margin-bottom: 15px;
        font-weight: 300 !important;
        text-align: center;
    }
    
    @media (max-width: 768px) {
        .otp-container {
            flex-direction: column;
        }
        
        .otp-right {
            order: -1;
            min-height: 300px;
            border-radius: 0;
        }
        
        .system-title, .right-title {
            font-size: 28px;
        }
        
        .system-subtitle, .right-subtitle {
            font-size: 24px;
        }
        
        .tagline {
            font-size: 18px;
        }
        
        .back-button {
            top: 15px;
            right: 15px;
            border-radius: 20px;
        }
    }
</style>

<div class="otp-container">
    <a href="{{ route('password.request') }}" class="back-button">BACK</a>
    
    <div class="otp-left">
        <div class="logo-placeholder">
            <img src="{{asset('assets/images/marsu-logo.png')}}" alt="MARSU Logo" height="120">
        </div>
        
        <h1 class="system-title">Verify OTP</h1>
        
        <p class="otp-instruction">Please enter the OTP to proceed</p>
        
       <form method="POST" class="otp-form">
            @csrf
            <input 
                id="otp" 
                type="text" 
                class="form-input{{ $errors->has('otp') ? ' is-invalid' : '' }}" 
                name="otp" 
                placeholder="OTP"
                required
                autofocus
                maxlength="6"
            >
            <button type="submit" class="btn-verify">
                Verify OTP
            </button>
        </form>
    </div>
    
    <div class="otp-right">
        <div class="right-logo-placeholder">
            <img src="{{asset('assets/images/marsu-logo.png')}}" alt="MARSU Logo" height="120">
        </div>
        
        <h2 class="right-title">MARSU</h2>
        <h3 class="right-subtitle">Library Management System</h3>
        
        <p class="tagline">
            "Your premier digital library <br> for borrowing and reading <br> books"
        </p>
    </div>
</div>
@endsection