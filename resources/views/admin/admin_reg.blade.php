<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Easiest Way to Add Input Masks to Your Forms</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<div>
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
    </div>
    <div class="registration-form">
        <form action="{{ url('/admin_singup') }}" method="post" enctype="multipart/form-data">
		@csrf
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="form-group">
                
                <input type="text" class="form-control item" name="name" id="name" placeholder="Name">
				@error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror

			</div>
			<div class="form-group">
                <input type="text" class="form-control item" name="email" id="email" placeholder="email">
				@error('email')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
			</div>
			<div class="form-group">
                <input type="password" class="form-control item" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="cpassword" name="cpassword" placeholder="Confirm Password">
            </div>
			<div class="form-group">
				<!-- <p>Student Image :- </p> -->
                <input type="file" class="form-control item" id="admin_img" name="admin_img" placeholder="admin_img image">
				@error('admin_img')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
			</div>

            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Create Account</button>
            </div>
        </form>
     
    </div>

</body>
</html>
<style>
	
.registration-form{
	padding: 50px 0;
    opacity:0.9;
}

.registration-form form{
    background-color:rgb(230, 230, 230);
    max-width: 600px;
    margin: auto;
    padding: 50px 70px;
    border-top-left-radius: 30px;
    border-top-right-radius: 30px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
}

.registration-form .form-icon{
	text-align: center;
    background-color: #5891ff;
    border-radius: 50%;
    font-size: 40px;
    color: white;
    width: 100px;
    height: 100px;
    margin: auto;
    margin-bottom: 50px;
    line-height: 100px;
}

.registration-form .item{
	border-radius: 20px;
    margin-bottom: 25px;
    padding: 10px 20px;
}

.registration-form .create-account{
    border-radius: 30px;
    padding: 10px 20px;
    font-size: 18px;
    font-weight: bold;
    background-color: #5791ff;
    border: none;
    color: white;
    margin-top: 20px;
}

.registration-form .social-media{
    max-width: 600px;
    background-color: #fff;
    margin: auto;
    padding: 35px 0;
    text-align: center;
    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;
    color: #9fadca;
    border-top: 1px solid #dee9ff;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
}

.registration-form .social-icons{
    margin-top: 30px;
    margin-bottom: 16px;
}

.registration-form .social-icons a{
    font-size: 23px;
    margin: 0 3px;
    color: #5691ff;
    border: 1px solid;
    border-radius: 50%;
    width: 45px;
    display: inline-block;
    height: 45px;
    text-align: center;
    background-color: #fff;
    line-height: 45px;
}

.registration-form .social-icons a:hover{
    text-decoration: none;
    opacity: 0.6;
}

@media (max-width: 576px) {
    .registration-form form{
        padding: 50px 20px;
    }

    .registration-form .form-icon{
        width: 70px;
        height: 70px;
        font-size: 30px;
        line-height: 70px;
    }
}
</style>