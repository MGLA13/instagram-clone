
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    </head>
    <body>
        <h2>Password recovery</h2>
        <p>
            Dear <b>{{$username}}</b>, this request was recently submitted to reset a password for your account. 
            If you have not made this request, just ignore this email.
        </p>
        <p>
            To reset your password, visit the following link <a href="{{ route('reset',$token) }}">reset password</a>
        </p>
        <p>Kind regards.</p>        
    </body>
</html>
