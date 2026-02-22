<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/login.css">
    <style>
        .form-container { max-width: 400px; margin: 50px auto; padding: 20px; border: 2px solid var(--gold); border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: var(--dark-navy); }
        .form-group input { width: 100%; padding: 8px; border: 1px solid var(--gold); border-radius: 4px; box-sizing: border-box; }
        .form-group button { width: 100%; padding: 10px; background: var(--gold); color: var(--dark-navy); border: none; border-radius: 4px; cursor: pointer; font-size: 1em; font-weight: bold; }
        .form-group button:hover { background: #c09000; }
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
                    <li style="list-style: none;"><a href="/login">Login</a></li>
                </div>
            </ul>
        </nav>
    </header>
    <main class="form-container">
        <h1>Register</h1>
        
        <?php if (isset($error)): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if (isset($success)): ?>
            <div class="message success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <form action="/register" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="your@email.com" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="At least 6 characters" required minlength="6">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" required minlength="6">
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        </form>
        
        <div class="form-footer">
            <p>Already have an account? <a href="/login">Login here</a></p>
        </div>
    </main>
    
    <footer>
        <div class="footer-element">
