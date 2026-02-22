<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/login.css">
    <style>
        .form-container { max-width: 400px; margin: 50px auto; padding: 20px; border: 2px solid var(--gold); border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: var(--dark-navy); }
        .form-group input { width: 100%; padding: 8px; border: 1px solid var(--gold); border-radius: 4px; box-sizing: border-box; }
        .form-group button { width: 100%; padding: 10px; background: var(--blue); color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1em; font-weight: bold; }
        .form-group button:hover { background: var(--dark-navy); }
        .message { padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        .message.error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .message.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .form-footer { text-align: center; margin-top: 15px; }
        .form-footer a { color: var(--blue); text-decoration: none; }
        .form-footer a:hover { text-decoration: underline; }
        .form-container h1 { color: var(--dark-navy); text-align: center; }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <ul class="nav-links" style="display: flex; align-items: center; justify-content: space-between; padding: 0; margin: 0;">
                <li style="list-style: none;"><a href="/home" class="nav-logo">🎬 CineApp</a></li>
                
                <div style="display: flex; gap: 15px; list-style: none; align-items: center;">
                    <li style="list-style: none;"><a href="/home">Movies</a></li>
                    <li style="list-style: none;"><a href="/register">Register</a></li>
                </div>
            </ul>
        </nav>
    </header>
    <main class="form-container">
        <h1>Login</h1>
        
        <?php if (isset($error)): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="/login" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="your@email.com" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
        
        <div class="form-footer">
            <p>Don't have an account? <a href="/register">Register here</a></p>
        </div>
    </main>
    
    <footer>
        <div class="footer-element">
