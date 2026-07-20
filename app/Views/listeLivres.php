<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des livres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/app-theme.css') ?>">
</head>
<body>
<div class="container py-4 fade-in">
    <div class="page-title">
        <h1 class="mb-0">Liste des livres</h1>
        <p>Bibliotheque - gestion rapide des ouvrages</p>
    </div>

    <div class="nav-actions">
        <a href="/ajouter" class="btn btn-primary">Ajouter un livre</a>
        <a href="/emprunts" class="btn btn-primary">Faire un emprunt</a>
        <a href="/rendre" class="btn btn-primary">Rendre un livre</a>
        <a href="/recherche" class="btn btn-primary">Rechercher un livre</a>
    </div>

    <?php if (!empty($Livres) && is_array($Livres)): ?>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Catégorie</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Livres as $livre): ?>
                    <tr>
                        <td><a href="/livres/<?= $livre['id'] ?>"><?= esc($livre['titre']) ?></a></td>
                        <td><?= esc($livre['auteur']) ?></td>
                        <td><?= esc($livre['categorie']) ?></td>
                        <td><?= esc($livre['statut']) ?></td>
                        <td>
                            <a href="admin/supprimer/<?= $livre['id'] ?>" class="btn btn-danger btn-sm">supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Aucun livre trouvé.</div>
    <?php endif; ?>
    <a href="/deconnexion" class="btn btn-secondary">Déconnexion</a>
</div>
</body>
</html>