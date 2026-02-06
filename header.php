<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF-8">
    <mata name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>
        <?php if(isset($title)&& !empty($title))
        {
            echo $title;
        }
        else{
            echo "Default Title";
        }
        ?>
        </title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333333;
            color: white;
            padding: 20px;
            text-align: center;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
         main {
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <body>
    <nav class="navbar navbar-expand-lg ...">
        </nav>

    <header>
        <h1>Welcome to My Website</h1>
    </header>

    <main class="container">
        </main>

    <footer> ... </footer>
</body>
    <header>
        <h1>Welcome to My Website</h1>
        <p>Your go-to source for web development tutorials</p>
    </header>