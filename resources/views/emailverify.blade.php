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
            <h1>Verify Your Email Address</h1>
            <p>Thanks for creating an account with us! To continue, please verify your email address.</p>

            <br>


            <p style="font-size: 30px; color:blue;"><a class="unsub" href="https://ls.elkyzer.link/verify/email/{{ $verification_token }}"
            style="color: blue;text-decoration:underline;">Activation Link</a></p>



        </div>
    </div>
</body>

</html>
