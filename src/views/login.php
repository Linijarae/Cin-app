<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <header>
        <img src="/logo.png" alt="Logo">
    </header>
    <form action="/login" method="POST">
        <label for="email"></label>
        <input type="email" name="email" id="email" placeholder="email">
        <label for="password"></label>
        <input type="password" name="password" id="password" placeholder="password">
        <button type="submit">Login</button>
    </form>
    <footer>
        <div>
            <p>© ZdarkBlackShadow and Linijarae</p>
        </div>
        <div>
            <a href="/cgu" target="_blank">CGU</a>
        </div>
    </footer>
</body>
</html>
