<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
    <main class="container">
        <h1>Reserve your place</h1>

        <div class="films-grid">
            <?php if (!empty($movies)): ?>
                <?php foreach ($movie as $movies): ?>
                    <article class="film-card">
                        <div class="film-image">
                            <img src="img/film_<?php echo $movie['id']; ?>.jpg" alt="<?php echo htmlspecialchars($movie['titre']); ?>">
                        </div>
                        <div class="film-content">
                            <h3><?php echo htmlspecialchars($movie['titre']); ?></h3>
                            <p class="film-desc"><?php echo htmlspecialchars($movie['description']); ?></p>
                            
                            <a href="/reserve?id=<?php echo $movie['id']; ?>" class="btn-reserver">
                                Reserve
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun film disponible pour le moment.</p>
            <?php endif; ?>
        </div>
    </main>
    <h1>Reserve your place fort the virtual cinema</h1>
</body>
</html>
