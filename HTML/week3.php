<?php require_once('functions.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>My Web Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        #header {
            background-image: url("forest.jpg");
            background-size: cover;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #navigation {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: right;
        }
        #navigation a {
            color: #fff;
            margin: 0 10px;
            text-decoration: none;
        }
        #left-sidebar {
            width: 20%;
            background-color: #f2f2f2;
            padding: 10px;
            display: inline-block;
        }
        #body-content {
            width: 60%;
            padding: 10px;
            display: inline-block;
        }
        #footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/js/foundation.min.js"></script>
    <script>
        function updateBody() {
            var newBodyText = "This is a new set of text in the body!";
            document.getElementById("body-content").innerHTML = newBodyText;
        }

        function showAlert() {
            alert("Button clicked!");
        }
    </script>
</head>
<body>
    <div id="navigation">
        <a href="#" onclick="updateBody(); return false;">Update Body</a> |
        <a href="#" onclick="showAlert(); return false;">Alert</a>
    </div>

    <div id="header"></div>

    <div id="left-sidebar">
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at porttitor purus. Saretra. Integer lobortis cursus tellus, sit amet dictum nulla vestibulum eu. Donec imperdiet, neque eget pellentesque viverra, enim vgiat enim ut pellentesque. Vestibulum bibendum, felis eget laoreet convallis, turpis lectus elementum odio, id feugiat ligula turpis a elit.
        </p>
    </div>

    <div id="body-content">
        <p>
            This is the body content of the web page.
        </p>
        <p>Current Date and Time: <?php echo displayDateTime(); ?></p>
    </div>

    <div id="footer">   
        <p>&copy; 2023 .Jason Kuegah Design by Jason Kuegah</p>
    </div>
</body>
</html>
        