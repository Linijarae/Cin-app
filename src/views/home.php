<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/home.css">
</head>
<body>
    <header>
        <nav>
            <a href="/" class="nav-logo">
                <img src="logo.png" alt="Logo Cinéma">
            </a>

            <ul class="nav-links">
                <li><a href="/">Home</a></li>
                
                <?php if (isset($_SESSION["login"])): ?>
                    <li>
                        <a href="/logout" class="btn-auth">Logout</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="/login" class="btn-auth">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main class="container">
        <h1>Reserve your place</h1>

        <div class="films-grid">
            <?php if (!empty($movies)): ?>
                <?php foreach ($movie as $movies): ?>
                    <article class="film-card">
                        <div class="film-image">
                            <img src="img/image<?php echo $movie['id']; ?>.jpg" alt="<?php echo htmlspecialchars($movie['titre']); ?>">
                        </div>
                        <div class="film-content">
                            <h3><?php echo htmlspecialchars($movie['titre']); ?></h3>
                            <p class="film-desc"><?php echo htmlspecialchars($movie['description']); ?></p>
                            
                            <a href="/reserve?id=<?php echo $movie['id']; ?>" class="btn-reserve">
                                Reserve
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Empty movie list</p>
            <?php endif; ?>
        </div>
    </main>
        <footer>
        <div class="footer-element">
            <p>© <a class="footer-link" target="_blank" href="https://github.com/ZdarkBlackShadow">ZdarkBlackShadow</a> and <a class="footer-link" target="_blank" href="https://github.com/Linijarae">Linijarae</a></p>
        </div>
        <div class="footer-element">
            <p>Graphist : <a class="footer-link" target="_blank" href="https://gemini.google.com">Gemini</a></p>
        </div>
        <div class="footer-element">
            <a class="footer-link" href="/cgu" target="_blank">CGU</a>
        </div>
    </footer>
</body>
</html>
