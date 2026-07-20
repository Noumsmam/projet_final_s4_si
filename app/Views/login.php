<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body{font-family:Arial,Helvetica,sans-serif;background:#f7f7f7;padding:40px}
        .card{max-width:420px;margin:40px auto;background:#fff;padding:20px;border-radius:6px;box-shadow:0 2px 6px rgba(0,0,0,.1)}
        label{display:block;margin:10px 0 4px;font-weight:600}
        input[type="email"],input[type="password"]{width:100%;padding:8px;border:1px solid #ccc;border-radius:4px}
        button{margin-top:14px;padding:10px 14px;background:#007bff;color:#fff;border:none;border-radius:4px;cursor:pointer}
        .error{color:#b00020;background:#ffe6e9;padding:8px;border-radius:4px;margin-bottom:10px}
    </style>
</head>
<body>
<div class="card">
    <h2>Connexion</h2>

    <?php if (!empty($erreur)): ?>
        <div class="error"><?= htmlspecialchars($erreur) ?></div>
    <?php endif; ?>

    <form action="/login" method="post">
        <?= csrf_field() ?>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required autofocus>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Se connecter</button>
    </form>
</div>
</body>
</html>