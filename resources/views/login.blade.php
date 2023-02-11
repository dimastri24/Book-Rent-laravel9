<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Buku | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<style>
    .main {
        height: 100vh;
        box-sizing: border-box;
    }

    .login-box {
        width: 500px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 5px 3px 30px 5px lightgray
    }
</style>

<body>

    <div class="main d-flex justify-content-center align-items-center">
        <div class="login-box">
            @if (session('status'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
            @endif
            <form action="" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary form-control">Login</button>
                </div>
                <div class="mb-3 text-end">
                    <p>Doesn't have account? <a href="/register">Sign Up</a></p>
                    <p><a href="/">Go Back</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>