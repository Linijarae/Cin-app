<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>Home</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li>Home</li>
                <?php (isset($_SESSION["connected"]) ? <div></div> : <div></div>  ?>
            </ul>
        </nav>
    </header>
</body>
</html>
