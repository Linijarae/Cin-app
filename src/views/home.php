<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Cinema App</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/home.css">
    <style>
        /* Un peu de CSS pour que les cartes soient jolies si home.css est vide */
        .movies-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; padding: 20px; }
        .movie-card { border: 1px solid #ddd; border-radius: 8px; overflow: hidden; padding: 15px; text-align: center; background: #fff; transition: transform 0.2s; }
        .movie-card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .movie-card img { width: 100%; height: 300px; object-fit: cover; border-radius: 4px; }
        .btn-reserve { display: inline-block; background: #e50914; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-top: 10px; }
        .btn-reserve:hover { background: #b20710; }
        nav ul { list-style: none; display: flex; gap: 15px; padding: 0; }
        nav a { text-decoration: none; color: #333; font-weight: bold; }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <ul class="nav-links" style="display: flex; align-items: center; justify-content: space-between; padding: 0; margin: 0;">
                <li style="list-style: none;"><a href="/home" class="nav-logo">🎬 CineApp</a></li>
                
                <div style="display: flex; gap: 15px; list-style: none; align-items: center;">
                    <li style="list-style: none;"><a href="/home">Movies</a></li>
                    
                    <?php if (isset($_SESSION["user_id"])): ?>
                        <li style="list-style: none;"><a href="/profile">My Profile</a></li>
                        <li style="list-style: none;"><a href="/logout" class="btn-auth">Logout (<?= htmlspecialchars($_SESSION['login'] ?? '') ?>)</a></li>
                    <?php else: ?>
                        <li style="list-style: none;"><a href="/register">Register</a></li>
                        <li style="list-style: none;"><a href="/login" class="btn-auth">Login</a></li>
                    <?php endif; ?>
                </div>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1>Now Showing</h1>

        <div style="background: linear-gradient(135deg, var(--dark-navy), var(--blue)); color: white; padding: 30px; border-radius: 10px; margin-bottom: 40px; border-left: 5px solid var(--gold);">
            <h2 style="color: var(--gold); margin-top: 0;">🎬 Ouvert 7 jours sur 7</h2>
            <p style="font-size: 1.1rem; margin-bottom: 15px;">Notre cinéma vous accueille tous les jours avec des séances à :</p>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
                <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px; text-align: center;">
                    <strong style="font-size: 1.3rem; color: var(--gold);">14h00</strong>
                </div>
                <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px; text-align: center;">
                    <strong style="font-size: 1.3rem; color: var(--gold);">17h00</strong>
                </div>
                <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px; text-align: center;">
                    <strong style="font-size: 1.3rem; color: var(--gold);">20h00</strong>
                </div>
                <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px; text-align: center;">
                    <strong style="font-size: 1.3rem; color: var(--gold);">22h30</strong>
                </div>
            </div>
            <p style="font-size: 0.95rem; margin-top: 15px; opacity: 0.9;">Réservez vos places dès maintenant pour profiter du meilleur du cinéma !</p>
        </div>

        <div class="movies-grid">
            <?php if (!empty($movies)): ?>
                <?php foreach ($movies as $movie): ?>
                    <div class="movie-card">
                        <?php 
                            $imgSrc = !empty($movie['image_url']) ? $movie['image_url'] : 'img/default-movie.jpg'; 
                        ?>
                        <img src="<?php echo htmlspecialchars($imgSrc); ?>" alt="<?php echo htmlspecialchars($movie['name']); ?>">
                        
                        <h3><?php echo htmlspecialchars($movie['name']); ?></h3>
                        
                        <p><?php echo substr(htmlspecialchars($movie['synopsis']), 0, 80); ?>...</p>
                        
                        <small>Release: <?php echo htmlspecialchars($movie['release_date']); ?></small>
                        <br>

                        <a href="/reservation?id=<?php echo $movie['id']; ?>" class="btn-reserve">Book Tickets</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No movies available at the moment.</p>
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