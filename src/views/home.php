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
                <?php if (isset($_SESSION["login"])): ?>
                <li>
                    <a href="/logout">Logout</a>
                </li>
                <?php else: ?>
                <li>
                    <a href="/login">Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <h1>Reserve your place fort the virtual cinema</h1>
</body>
</html>
