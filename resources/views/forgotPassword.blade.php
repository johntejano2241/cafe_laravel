<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>

</head>

<body>

</body>
<!DOCTYPE html>
<html>

<head>

    <style>
        body {
            background-color: #f5f8fa;
        }

        .container {
            width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .content {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px #ccc;
        }

        h1 {
            margin-top: 0;
        }

        form {
            margin-top: 30px;
        }

        .btn {
            background-color: #3490dc;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #2980b9;
        }
    </style>

    <title>Verify Your Email Address</title>
</head>

<body>
    <div class="container">
        <div class="content">
            <h1>Forgot Password</h1>
            <p>If you are not requesting this, please ignore this email.</p>

            <br>

            <p style="font-size: 30px; color: red;"><a class="unsub" href="https://ls.elkyzer.link/forgot/password/{{ $verification_token }}"
            style="color: red;text-decoration:underline;">Reset Password Link</a></p>

        </div>
    </div>
</body>

</html>


</html>
