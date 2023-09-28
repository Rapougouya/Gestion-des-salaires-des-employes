<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('css/auth.css')}}">

<form method="post" action="{{route('submitDefineAccess', $email)}}">

    @csrf
    @method('POST')

    <div class="box">
        <h1>Definissez vos accès</h1>
        @if (Session::get('error_msg'))
            <b style="font-size: 10px; color: rgb(204, 95, 95);">{{Session::get('error_msg')}}</b>
        @endif

        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" class="email" value="{{$email}}" readonly/>
        </div>
        <div class="form-group">
            <label for="">Code</label>
            <input type="text" name="code" class="email" value="{{old('code')}}"/>
            @error('code')
              <span class=" text text-danger">{{$message}}</span>
           @enderror
        </div>
        <div class="form-group">
            <label for="">Mot de passe</label>
            <input type="password" name="password" class="email" />
            @error('password')
                <span class=" text text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Mot de passe de confirmation</label>
            <input type="password" name="confirm-password" class="email" />

            @error('confirm_password')
               <span class="text text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="btn-container">
            <button type="submit"> Valider</button>
        </div>

        
    </div>
    
</form>

</body>
</html>
<style>
    .form-group{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-bottom: 1rem; 
    }
    .text-danger{
        color: rgb(231, 50, 50)!important;
    }
</style>