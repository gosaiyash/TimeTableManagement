<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download and Redirect</title>
</head>
<body>
    <h1>Downloading your file...</h1>

    <script>
        // Trigger the file download
        window.location.href = "{{ url('/download_csv_faculty') }}";

        // Redirect to the main page after a delay
        setTimeout(function () {
            window.location.href = "{{ url('/viewfaculty') }}"; // Replace 'home' with your main page route name
        }, 2000); // Redirect after 3 seconds
    </script>
</body>
</html>