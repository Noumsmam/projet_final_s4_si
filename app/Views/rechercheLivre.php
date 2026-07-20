<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app-theme.css') ?>">
</head>
<body>
    <div class="container py-4 fade-in">
        <div class="app-card p-4">
            <div class="page-title">
                <h1 class="mb-0">Rechercher un livre</h1>
                <p>Filtre par titre ou categorie</p>
            </div>

            <form action="/rechercher" method="post" class="mb-3">
                <p><input type="text" name="query" placeholder="Titre"></p>
                <p>
                <label for="categorie">Catégorie:</label>
                <select name="categorie" id="categorie">
                    <option value="">Aucune categorie</option>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?= esc($categorie) ?>"><?= esc($categorie) ?></option>
                    <?php endforeach; ?>
                </select>
                </p>
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
            <p><a href="/" class="btn btn-secondary">Liste des livres</a></p>
        </div>
    </div>
</body>
</html>