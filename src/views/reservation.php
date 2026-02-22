<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titre) ? $titre : 'Reservation' ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        /* Un peu de CSS inline pour dépanner si ton style.css n'est pas prêt */
        .reservation-container { display: flex; gap: 2rem; margin-top: 20px; }
        .movie-info { flex: 1; text-align: center; }
        .movie-info img { max-width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        .booking-form { flex: 1; padding: 20px; background: #f9f9f9; border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        .alert.error { background: #ffebee; color: #c62828; border: 1px solid #ef9a9a; }
        .alert.success { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
        .btn-submit { background-color: #333; color: white; padding: 10px 20px; border: none; cursor: pointer; width: 100%; font-size: 16px; }
        .btn-submit:hover { background-color: #555; }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/home">Home</a></li>
                <li><a href="/profile">My Profile</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1>Book Your Seats</h1>

        <?php if (isset($error)): ?>
            <div class="alert error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="alert success">
                <?= htmlspecialchars($success) ?>
                <p><a href="/profile">View my reservations</a> or <a href="/home">Back to movies</a></p>
            </div>
        <?php elseif (isset($movie) && $movie): ?>
            <div class="reservation-container">
                
                <div class="movie-info">
                    <h2><?= htmlspecialchars($movie['name']) ?></h2>
                    <?php if (!empty($movie['image_url'])): ?>
                        <img src="/<?= htmlspecialchars($movie['image_url']) ?>" alt="<?= htmlspecialchars($movie['name']) ?>">
                    <?php endif; ?>
                    <p><strong>Release Date:</strong> <?= htmlspecialchars($movie['release_date']) ?></p>
                </div>

                <form action="/reservation" method="POST" class="booking-form">
                    <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">

                    <div class="form-group">
                        <label for="date">Date of screening:</label>
                        <input type="date" id="date" name="date" required min="<?= date('Y-m-d') ?>">
                    </div>

                    <div class="form-group">
                        <label for="time">Time:</label>
                        <select id="time" name="time" required>
                            <option value="14:00">14:00</option>
                            <option value="17:00">17:00</option>
                            <option value="20:00">20:00</option>
                            <option value="22:30">22:30</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="seats">Number of seats:</label>
                        <input type="number" id="seats" name="seats" min="1" max="10" value="1" required>
                    </div>

                    <div class="form-group">
                        <p>Total Price: <strong><span id="price-display">10.00</span> €</strong></p>
                    </div>

                    <button type="submit" class="btn-submit">Confirm Reservation</button>
                </form>
            </div>

        <?php else: ?>
            <div style="text-align: center; margin-top: 50px;">
                <p>No movie selected. Please go back to the home page and select a movie to book.</p>
                <a href="/home" class="btn-submit" style="text-decoration: none; display: inline-block; width: auto;">Browse Movies</a>
            </div>
        <?php endif; ?>

    </main>

    <script>
        const seatsInput = document.getElementById('seats');
        const priceDisplay = document.getElementById('price-display');
        const pricePerSeat = 10;

        if(seatsInput) {
            seatsInput.addEventListener('input', function() {
                const count = this.value;
                const total = count * pricePerSeat;
                priceDisplay.textContent = total.toFixed(2);
            });
        }
    </script>
</body>
</html>