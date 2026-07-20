<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultat</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app-theme.css') ?>">
</head>
<body>
    <div class="container py-4 fade-in">
        <div class="app-card p-4">
            <div class="page-title">
                <h1 class="mb-0">Résultats de la recherche</h1>
                <p>Selection correspondant a vos criteres</p>
            </div>

            <?php if (isset($livres) && count($livres) > 0): ?>
                <ul>
                    <?php foreach ($livres as $livre): ?>
                        <li>
                            <strong><?= esc($livre['titre']) ?></strong> par <?= esc($livre['auteur']) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun livre trouvé pour votre recherche.</p>
            <?php endif; ?>
            <a href="/recherche" class="btn btn-secondary">Retour a la recherche</a>
        </div>
    </div>
</body>
</html>