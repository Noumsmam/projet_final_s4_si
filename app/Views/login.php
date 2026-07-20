<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/assets/css/app-theme.css">
</head>
<body>
    <main class="auth-shell">
        <div class="auth-layout fade-in">
            <section class="auth-hero">
                <p class="page-kicker">Portail client</p>
                <h1 class="hero-title">Accédez à votre compte bancaire avec une interface plus moderne.</h1>
                <p class="hero-subtitle">Connectez-vous avec votre numéro pour consulter votre solde, déposer, retirer et suivre vos opérations.</p>
                <p class="side-note">Design unifié, lecture plus claire et saisie plus confortable sur mobile comme sur desktop.</p>
            </section>

            <section class="auth-panel">
                <p class="page-kicker">Connexion</p>
                <h2>Bienvenue</h2>
                <form action="/login" method="post" class="form-stack">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="numero">Numéro</label>
                        <input type="text" id="numero" name="numero" required placeholder="Ex: 0331234567">
                        <p class="input-hint">Saisissez votre identifiant téléphonique complet.</p>
                    </div>
                    <div class="actions-row">
                        <button type="submit" class="btn-primary">Se connecter</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</body>
</html>