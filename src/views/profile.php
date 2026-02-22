<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .profile-header { background: #f4f4f4; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .res-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .res-table th, .res-table td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        .res-table th { background-color: #333; color: white; }
        .btn-cancel { background-color: #ff9800; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        .btn-delete-account { background-color: #f44336; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px; }
        .danger-zone { margin-top: 40px; padding: 20px; border: 1px solid #f44336; border-radius: 8px; }
        .status-message { padding: 10px; margin-bottom: 10px; border-radius: 4px; }
        .success { background-color: #dff0d8; color: #3c763d; }
        .error { background-color: #f2dede; color: #a94442; }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <ul style="display: flex; gap: 15px; list-style:none;">
                <li><a href="/home">Home</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <?php if (isset($message)): ?>
            <div class="status-message <?= isset($success) && $success ? 'success' : 'error' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <section class="profile-header">
            <?php if(isset($user)): ?>
                <h1>Hello, <?= htmlspecialchars($user['login']) ?></h1>
                <p>Email: <?= htmlspecialchars($user['email']) ?></p>
                <p>Member since: <?= htmlspecialchars(date('F Y', strtotime($user['created_at']))) ?></p>
            <?php else: ?>
                <h1>Profil</h1>
                <p>Erreur de chargement du profil.</p>
            <?php endif; ?>
        </section>

        <section>
            <h2>Your Reservations</h2>
            <?php if (empty($reservations)): ?>
                <p>You haven't booked any movies yet. <a href="/home">Go check out our movies!</a></p>
            <?php else: ?>
                <table class="res-table">
                    <thead>
                        <tr>
                            <th>Movie</th>
                            <th>Date & Time</th>
                            <th>Seats</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $res): ?>
                            <tr>
                                <td>
                                    <strong><?= htmlspecialchars($res['movie_name']) ?></strong>
                                </td>
                                <td>
                                    <?= date('d/m/Y H:i', strtotime($res['screening_date'])) ?>
                                </td>
                                <td><?= htmlspecialchars($res['number_of_seats']) ?></td>
                                <td><?= htmlspecialchars($res['total_price']) ?> €</td>
                                <td>
                                    <form action="/profile/cancel" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                        <input type="hidden" name="reservation_id" value="<?= $res['id'] ?>">
                                        <button type="submit" class="btn-cancel">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>

        <section class="danger-zone">
            <h3>Danger Zone</h3>
            <p>Deleting your account is permanent and will cancel all your current reservations.</p>
            <form action="/profile/delete" method="POST" onsubmit="return confirm('WARNING: Are you sure you want to delete your account? This cannot be undone.');">
                <button type="submit" class="btn-delete-account">Delete My Account</button>
            </form>
        </section>
    </main>
</body>
</html>