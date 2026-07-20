<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un livre</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/app-theme.css') ?>">
</head>
<body class="bg-light">
<div class="container py-4 fade-in">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-3">Ajouter un livre</h4>

                    <?php if (!empty(session()->getFlashdata('success'))): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    <?php if (!empty(session()->getFlashdata('error'))): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <?php $old = isset($old) ? $old : [];
                    $errors = isset($errors) ? $errors : [];
                    ?>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $err): ?>
                                    <li><?= htmlspecialchars($err, ENT_QUOTES) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="/creer" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" name="titre" class="form-control" required value="<?= htmlspecialchars($old['titre'] ?? '', ENT_QUOTES) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Auteur</label>
                            <input type="text" name="auteur" class="form-control" required value="<?= htmlspecialchars($old['auteur'] ?? '', ENT_QUOTES) ?>">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">ISBN</label>
                                <input type="text" name="isbn" class="form-control" value="<?= htmlspecialchars($old['isbn'] ?? '', ENT_QUOTES) ?>">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Année</label>
                                <input type="number" name="annee_publication" min="1800" max="2100" class="form-control" value="<?= htmlspecialchars($old['annee_publication'] ?? '', ENT_QUOTES) ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catégorie</label>
                            <input type="text" name="categorie" class="form-control" value="<?= htmlspecialchars($old['categorie'] ?? '', ENT_QUOTES) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Résumé</label>
                            <textarea name="resume" rows="5" class="form-control"><?= htmlspecialchars($old['resume'] ?? '', ENT_QUOTES) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Couverture (jpg, png)</label>
                            <input type="file" name="couverture_filename" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Statut</label>
                            <select name="statut" class="form-select">
                                <?php $s = $old['statut'] ?? 'disponible'; ?>
                                <option value="disponible" <?= $s === 'disponible' ? 'selected' : '' ?>>Disponible</option>
                                <option value="prêté" <?= $s === 'prêté' ? 'selected' : '' ?>>Prêté</option>
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                            <a href="/" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>