<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendre un livre</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app-theme.css') ?>">
</head>
<body>
    <div class="container py-4 fade-in">
        <div class="app-card p-4">
            <div class="page-title">
                <h1 class="mb-0">Rendre un livre</h1>
                <p>Selectionnez le livre a retourner</p>
            </div>
            <ul>
                <?php foreach ($emprunt as $e): ?>
                    <li>
                        <a href="/rendre/<?= esc($e['emprunt_id']) ?>"><?= esc($e['titre']) ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a href="/" class="btn btn-secondary">Retour a l'accueil</a>
        </div>
    </div>
</body>
</html>