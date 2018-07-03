<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Panel | GiftMe!</title>
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/floating-labels/floating-labels.css" rel="stylesheet">
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
</head>

<body>
<form class="form-signin" action="" method="POST">
    <div class="text-center mb-4">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">GiftMe!</h1>
        <p>Simple and fast <code>send gift.</code></p>
    </div>
        <div class="form-label-group">
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputEmail">Email address</label>
        </div>

        <div class="form-label-group">
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <label for="inputPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me" name="remember"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block signin" type="submit">Sign in</button>


    <p class="mt-5 mb-3 text-muted text-center">&copy; 2018</p>
</form>
</body>

<script type="text/javascript">
    $(document).ready(function(){
        $('html').on('click','.signin',function(e){
            e.preventDefault()
            $.ajax({
                type: "POST",
                url: '{{ route('api.guest.user.login') }}',
                data: $('.form-signin').serialize(),
                dataType: 'json',
                xhrFields: { withCredentials: true },
                success: function(response){
                    window.location.href = '{{ route('web.index') }}';
                },
                error: function(){
                    alert('Lütfen bilgilerinizi kontrol ediniz.');
                }
            });
        });
    });
</script>
</html>
