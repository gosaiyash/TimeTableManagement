<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student tt Gallery</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <h1>Student Time Table Gallery</h1>
        <!-- <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="/updatestudent">Update Profile</a></li>
                <li><a href="/logout">LogOut</a></li>
            </ul>
            <div>
         @if(Session::has('success'))
        <div class="alert alert-success" id="session2">
            
            <img src=" {{ Session::get('uimg') }}" alt="Student_img">

            {{ Session::get('uname') }}

            {{ Session::get('success') }}

        </div>
        @endif
    </div>
        </nav> -->
        </header>
    <div class="navbar">
    <a href="/updatestudent" class="active1">Update Profile</a>
    <a href="/logout">LogOut</a>
    <p id="p1"> {{ Session::get('uname') }}</p>
    <a href="#"><img src=" {{ Session::get('uimg') }}" alt="Student_img"></a>
  </div>


    <main>
        <section id="home">
            <h2>Welcome to the TT Gallery</h2>
            <p>Explore the latest Time Tables uploaded by the admin.</p>
        </section>

        <section id="gallery">
            <h2>TT Gallery</h2>
            <div class="gallery-container">
                <div class="gallery-item">
                    <img src="image1.jpg" alt="Image 1">
                </div>
                <div class="gallery-item">
                    <img src="image2.jpg" alt="Image 2">
                </div>
                <div class="gallery-item">
                    <img src="image3.jpg" alt="Image 3">
                </div>
                <div class="gallery-item">
                    <img src="image4.jpg" alt="Image 4">
                </div>
                <div class="gallery-item">
                    <img src="image5.jpg" alt="Image 5">
                </div>
                <div class="gallery-item">
                    <img src="image6.jpg" alt="Image 6">
                </div>
                <!-- Add more images as needed -->
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Student TT Gallery. All rights reserved.</p>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>
</body>
</html>

<style>
* {
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

header {
    background: #35424a;
    color: #ffffff;
    padding: 20px 0;
    text-align: center;
}
img
        {
            width:40px;
            height:43px;
            border-radius:60px;
            padding:0px;
            margin:0px;
        }

nav ul {
    list-style: none;
    padding: 0;
}

nav ul li {
    display: inline;
    margin: 0 15px;
}

nav ul li a {
    color: #ffffff;
    text-decoration: none;
    font-weight: bold;
}

main {
    padding: 20px;
}

h2 {
    color: #35424a;
}

.gallery-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.gallery-item {
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.gallery-item img {
    width: 100%;
    height: auto;
    transition: transform 0.3s;
}

.gallery-item img:hover {
    transform: scale(1.05);
}

footer {
    background: #35424a;
    color: #ffffff;
    text-align: center;
    padding: 10px 0;
    position: relative;
}

.social-icons {
    margin-top: 10px;
}

.social-icons a {
    color: #ffffff;
    margin: 0 10px;
    text-decoration: none;
    font-size: 20px;
}
.navbar {
      display: flex;
      background-color: #333;
      padding: 10px 20px;
    }
    .navbar a {
      color: white;
      text-decoration: none;
      padding: 10px 15px;
      margin-right: 10px;
      border-radius: 5px;
      transition: background-color 0.3s;

    }
    .active1
    {
        margin-left:820px;
    }
    .navbar a:hover {
      background-color: #575757;
    }
    .navbar a.active {
      background-color: #4CAF50;
    }
    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #333;
      padding: 10px 20px;
    }
    .navbar a {
      color: white;
      text-decoration: none;
      padding: 10px 15px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .navbar a:hover {
      background-color: #575757;
    }
    .navbar a.active {
      background-color: #4CAF50;
    }
    .user-profile {
      display: flex;
      align-items: center;
    }
    .user-profile img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-left: 10px;
      border: 2px solid white;
    }
    #p1
    {
        color:yellow;
        font-family:bold;
    }    
</style>