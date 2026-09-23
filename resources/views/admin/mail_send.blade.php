<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
</head>
<body>
    <h1>Mail successfully sended...</h1>

    <script>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
         @endif

        // Redirect to the main page after a delay
        setTimeout(function () {
            window.location.href = "{{ url('/admin') }}"; // Replace 'home' with your main page route name
        }, 5000); 
    </script>
</body>
</html>