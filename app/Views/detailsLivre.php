<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du livre</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/app-theme.css') ?>">
</head>
<body class="bg-light">
<div class="container py-4 fade-in">
    <?php if (isset($livre) && !empty($livre)): ?>
        <div class="card mb-3 shadow-sm">
            <div class="row g-0">
                <div class="col-md-4 d-flex align-items-center justify-content-center bg-white">
                    <?php
                    $cover = $livre['couverture_filename'] ?? ($livre['image'] ?? '');
                    if (!empty($cover)):
                        $coverUrl = function_exists('base_url') ? base_url('uploads/' . $cover) : ('uploads/' . $cover);
                    ?>
                        <img src="<?= htmlspecialchars($coverUrl, ENT_QUOTES) ?>" class="img-fluid p-3" alt="Couverture">
                    <?php else: ?>
                        <div class="text-muted p-5">Pas d'image</div>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title mb-2"><?= htmlspecialchars($livre['titre'] ?? 'Titre inconnu', ENT_QUOTES) ?></h3>
                        <p class="mb-1"><strong>Auteur :</strong> <?= htmlspecialchars($livre['auteur'] ?? 'Inconnu', ENT_QUOTES) ?></p>
                        <?php if (!empty($livre['isbn'])): ?><p class="mb-1"><strong>ISBN :</strong> <?= htmlspecialchars($livre['isbn'], ENT_QUOTES) ?></p><?php endif; ?>
                        <?php if (!empty($livre['annee_publication'])): ?><p class="mb-1"><strong>Année :</strong> <?= htmlspecialchars($livre['annee_publication'], ENT_QUOTES) ?></p><?php endif; ?>
                        <?php if (!empty($livre['categorie'])): ?><p class="mb-1"><strong>Catégorie :</strong> <?= htmlspecialchars($livre['categorie'], ENT_QUOTES) ?></p><?php endif; ?>
                        <?php if (!empty($livre['prix'])): ?><p class="mb-1"><strong>Prix :</strong> <?= htmlspecialchars($livre['prix'], ENT_QUOTES) ?> €</p><?php endif; ?>
                        <?php if (!empty($livre['statut'])): ?><p class="mb-1"><strong>Statut :</strong> <?= htmlspecialchars($livre['statut'], ENT_QUOTES) ?></p><?php endif; ?>
                        <?php if (!empty($dernierEmprunt)): ?>
                            <p class="mb-1"><strong>Dernier emprunté par :</strong> <?= htmlspecialchars($dernierEmprunt['nom_emprunteur'] ?? 'Inconnu', ENT_QUOTES) ?></p>
                            <p class="mb-1"><strong>Date du dernier emprunt :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($dernierEmprunt['date_emprunt'])), ENT_QUOTES) ?></p>
                        <?php endif; ?>
                        <hr>
                        <h5>Résumé</h5>
                        <p><?= nl2br(htmlspecialchars($livre['resume'] ?? ($livre['description'] ?? 'Aucun résumé'), ENT_QUOTES)) ?></p>
                        <hr>
                        <div class="small text-muted">
                            <?php if (!empty($livre['created_at'])): ?>Créé le <?= htmlspecialchars(date('d/m/Y H:i', strtotime($livre['created_at'])), ENT_QUOTES) ?><?php endif; ?>
                            <?php if (!empty($livre['updated_at'])): ?> — Modifié le <?= htmlspecialchars(date('d/m/Y H:i', strtotime($livre['updated_at'])), ENT_QUOTES) ?><?php endif; ?>
                        </div>
                        <div class="mt-3">
                            <a href="javascript:history.back()" class="btn btn-secondary">Retour</a>
                            <?php if (!empty($livre['id'])): ?>
                                <a href="<?= site_url('livres/edit/' . urlencode($livre['id'])) ?>" class="btn btn-primary ms-2">Modifier</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">Aucun détail de livre disponible.</div>
    <?php endif; ?>
</div>
</body>
</html>