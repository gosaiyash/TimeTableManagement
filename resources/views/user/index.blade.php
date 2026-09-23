<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
</head>
<body>

    <div>
         @if(Session::has('success'))
        <div class="alert alert-success" id="session2">
            {{ Session::get('success') }}

            {{ Session::get('uname') }}
        </div>
        @endif
    </div>
    
    <a href="/singup">Singup</a>
    <a href="/login">Login</a>
    <a href="/add_subject">Subject</a>
    <a href="/add_faculty">Faculty</a>
    <a href="/view_subject">view Subject</a>
    <a href="/download_subject">Download Subject</a>
    <a href="/viewfaculty">View faculty details</a>
</body>
</html>