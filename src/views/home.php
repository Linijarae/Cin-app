<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .films-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .film-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        .film-card img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }
        .film-card h3 {
            margin: 10px 0;
        }
        .film-card p {
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/home">Home</a></li>
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
                <?php foreach ($movies as $movie): ?>
                    <div class="film-card">
                        <img src="<?php echo htmlspecialchars($movie['image_url']); ?>" alt="<?php echo htmlspecialchars($movie['name']); ?>">
                        <h3><?php echo htmlspecialchars($movie['name']); ?></h3>
                        <p><?php echo substr(htmlspecialchars($movie['synopsis']), 0, 100); ?>...</p>
                        <small><?php echo htmlspecialchars($movie['release_date']); ?></small>
                        <br><br>
                        <a href="/reservation?movie_id=<?php echo $movie['id']; ?>">Reserve</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No movies available.</p>
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
