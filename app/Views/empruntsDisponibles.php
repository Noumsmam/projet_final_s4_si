<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunts</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app-theme.css') ?>">
</head>
<body>
    <div class="container py-4 fade-in">
        <div class="app-card p-4">
            <div class="page-title">
                <h1 class="mb-0">Emprunts disponibles</h1>
                <p>Choisissez un ouvrage a emprunter</p>
            </div>
            <ul>
                <?php if (!empty($livredisponible) && is_array($livredisponible)): ?>
                    <?php foreach ($livredisponible as $livre): ?>
                        <li><a href="/emprunter/<?= esc($livre['id']) ?>" class="btn btn-primary">Emprunter</a> <?= esc($livre['titre']) ?> par <?= esc($livre['auteur']) ?></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>Aucun livre disponible pour emprunt.</li>
                <?php endif; ?>
            </ul>
            <a href="/" class="btn btn-secondary">Retour a l'accueil</a>
        </div>
    </div>
</body>
</html>