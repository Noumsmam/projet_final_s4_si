<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des clients</title>
    <link rel="stylesheet" href="/assets/css/app-theme.css">
    <style>
        .admin-main {
            margin-left: 0;
            align-items: flex-start;
            padding-top: 48px;
        }

        .admin-panel {
            width: 100%;
            max-width: 1100px;
            border: 1px solid rgba(220, 230, 213, 0.95);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.92);
            box-shadow: var(--shadow-soft);
            padding: 28px;
        }

        .table-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .table-actions .btn {
            color: #fff;
            text-decoration: none;
            font-size: 0.85rem;
            padding: 0.45rem 0.9rem;
        }

        .inline-form {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="app-shell">
        <main class="app-main admin-main">
            <section class="admin-panel fade-in">
                <div class="page-title">
                    <div>
                        <p class="page-kicker">Administration</p>
                        <h1 class="hero-title" style="font-size: 2rem;">Gestion des clients</h1>
                        <p class="hero-subtitle">Liste de tous les comptes clients avec leurs soldes.</p>
                    </div>
                    <a href="/gestion-clients/creer" class="btn btn-success">Nouveau client</a>
                </div>

                <?php if (session()->getFlashdata('error')) { ?>
                    <div class="alert alert-danger">
                        <?= esc(session()->getFlashdata('error')) ?>
                    </div>
                <?php } ?>
                <?php if (session()->getFlashdata('success')) { ?>
                    <div class="alert alert-success">
                        <?= esc(session()->getFlashdata('success')) ?>
                    </div>
                <?php } ?>

                <?php if (empty($clients)) : ?>
                    <p class="empty-state">Aucun client enregistré.</p>
                <?php else : ?>
                    <div class="data-table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Numéro de compte</th>
                                    <th>Solde</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clients as $ligne) : ?>
                                    <tr>
                                        <td><?= esc($ligne['id']) ?></td>
                                        <td><?= esc($ligne['nom']) ?></td>
                                        <td><?= esc($ligne['prefixe_num'] ?? '') ?><?= esc($ligne['num']) ?></td>
                                        <td class="amount-cell"><?= number_format((float) ($ligne['solde'] ?? 0), 0, ',', ' ') ?> Ar</td>
                                        <td>
                                            <div class="table-actions">
                                                <a href="/gestion-clients/modifier/<?= esc($ligne['id']) ?>" class="btn btn-primary">Modifier</a>
                                                <form action="/gestion-clients/supprimer/<?= esc($ligne['id']) ?>" method="post" class="inline-form" onsubmit="return confirm('Supprimer ce client ?');">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>
</html>
