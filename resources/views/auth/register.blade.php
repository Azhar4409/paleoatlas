<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Register Form Design | CodeLab</title>
      <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        *{
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: 'Poppins', sans-serif;
        }
        html,body{
          display: grid;
          height: 100%;
          width: 100%;
          place-items: center;
          background: #f2f2f2;
        }
        ::selection{
          background: #4158d0;
          color: #fff;
        }
        .wrapper{
          width: 380px;
          background: #fff;
          border-radius: 15px;
          box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
        }
        .wrapper .title{
          font-size: 35px;
          font-weight: 600;
          text-align: center;
          line-height: 100px;
          color: #fff;
          user-select: none;
          border-radius: 15px 15px 0 0;
          background: linear-gradient(-135deg, #c850c0, #4158d0);
        }
        .wrapper form{
          padding: 10px 30px 50px 30px;
        }
        .wrapper form .field{
          height: 50px;
          width: 100%;
          margin-top: 20px;
          position: relative;
        }
        .wrapper form .field input{
          height: 100%;
          width: 100%;
          outline: none;
          font-size: 17px;
          padding-left: 20px;
          border: 1px solid lightgrey;
          border-radius: 25px;
          transition: all 0.3s ease;
        }
        .wrapper form .field input:focus,
        form .field input:valid{
          border-color: #4158d0;
        }
        .wrapper form .field label{
          position: absolute;
          top: 50%;
          left: 20px;
          color: #999999;
          font-weight: 400;
          font-size: 17px;
          pointer-events: none;
          transform: translateY(-50%);
          transition: all 0.3s ease;
        }
        form .field input:focus ~ label,
        form .field input:valid ~ label{
          top: 0%;
          font-size: 16px;
          color: #4158d0;
          background: #fff;
          transform: translateY(-50%);
        }
        form .field input[type="submit"]{
          color: #fff;
          border: none;
          padding-left: 0;
          margin-top: 20px;
          font-size: 20px;
          font-weight: 500;
          cursor: pointer;
          background: linear-gradient(-135deg, #c850c0, #4158d0);
          transition: all 0.3s ease;
          border-radius: 25px;
          height: 50px;
        }
        form .field input[type="submit"]:active{
          transform: scale(0.95);
        }
        .error-message {
          color: red;
          font-size: 14px;
          margin-top: 5px;
          margin-left: 20px;
        }
      </style>
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
            Register Form
         </div>
         <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="field">
               <input type="text" name="name" value="{{ old('name') }}" required autofocus>
               <label>Name</label>
               @error('name')
                 <div class="error-message">{{ $message }}</div>
               @enderror
            </div>
            <div class="field">
               <input type="email" name="email" value="{{ old('email') }}" required>
               <label>Email Address</label>
               @error('email')
                 <div class="error-message">{{ $message }}</div>
               @enderror
            </div>
            <div class="field">
               <input type="password" name="password" required>
               <label>Password</label>
               @error('password')
                 <div class="error-message">{{ $message }}</div>
               @enderror
            </div>
            <div class="field">
               <input type="password" name="password_confirmation" required>
               <label>Confirm Password</label>
            </div>
            <div class="field">
               <input type="submit" value="Register">
            </div>
         </form>
      </div>
   </body>
</html>
