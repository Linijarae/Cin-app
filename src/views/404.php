<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .error-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 70vh;
            text-align: center;
        }
        .error-container h1 {
            font-size: 4em;
            color: #dc3545;
            margin: 0;
        }
        .error-container p {
            font-size: 1.5em;
            color: #666;
            margin: 10px 0;
        }
        .error-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .error-container a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/home">Home</a></li>
                <li><a href="/login">Login</a></li>
            </ul>
        </nav>
    </header>
    <main class="error-container">
        <h1>404</h1>
        <p>Page not found</p>
        <p>The page you are looking for does not exist.</p>
        <a href="/home">Back to Home</a>
    </main>
    <footer>
        <p>&copy; 2026 Cin-app. All rights reserved.</p>
    </footer>
