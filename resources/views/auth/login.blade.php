<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href='https://fonts.googleapis.com/css?family=Barrio' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <div class="logobox">
                    HOSPITAL
                </div>
                <div class="form">
                    <form class="login-form" action="{{ route('login') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="email" class="form-username" name="email" placeholder="Email" value="{{ old('email') }}" autofocus/>
                        <input type="password" class="form-password" name="password" placeholder="password" />
                        <button>login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>