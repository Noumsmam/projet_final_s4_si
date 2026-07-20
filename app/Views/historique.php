<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des transactions</title>
    <link rel="stylesheet" href="/assets/css/app-theme.css">
</head>
<body>
    <?php
    $clientRow = $client ?? [];
    if (is_array($clientRow) && isset($clientRow[0]) && is_array($clientRow[0])) {
        $clientRow = $clientRow[0];
    }
    $prefixeRow = $prefixe ?? [];
    $nbTransactions = is_array($historique ?? null) ? count($historique) : 0;
    ?>
    <div class="app-shell">
        <?= view('partials/sidebar') ?>

        <main class="app-main">
            <div class="page-grid fade-in">
                <section class="hero-panel">
                    <p class="page-kicker">Espace client</p>
                    <h1 class="hero-title">Historique de <?= esc($clientRow['nom'] ?? '') ?></h1>
                    <p class="hero-subtitle">Consultez l’ensemble de vos opérations enregistrées : dépôts, retraits et transferts effectués sur votre compte.</p>

                    <div class="summary-grid">
                        <article class="summary-card">
                            <span class="summary-label">Numéro de compte</span>
                            <div class="summary-value"><?= esc($prefixeRow['num'] ?? '') ?><?= esc($clientRow['num'] ?? '') ?></div>
                        </article>
                        <article class="summary-card">
                            <span class="summary-label">Transactions</span>
                            <div class="summary-value"><?= $nbTransactions ?></div>
                        </article>
                    </div>
                </section>

                <section class="form-panel">
                    <p class="page-kicker">Mouvements</p>
                    <h2>Liste des transactions</h2>

                    <?php if (empty($historique)) : ?>
                        <p class="empty-state">Aucune transaction enregistrée pour le moment.</p>
                    <?php else : ?>
                        <div class="data-table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Type</th>
                                        <th>Montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($historique as $ligne) : ?>
                                        <?php
                                            $type = strtolower($ligne['type']);
                                            $badgeClass = match ($type) {
                                                'depot' => 'badge-depot',
                                                'retrait' => 'badge-retrait',
                                                'transfert' => 'badge-transfert',
                                                default => '',
                                            };
                                        ?>
                                        <tr>
                                            <td><?= esc($ligne['id']) ?></td>
                                            <td>
                                                <span class="badge-op <?= $badgeClass ?>"><?= esc($ligne['type']) ?></span>
                                            </td>
                                            <td class="amount-cell"><?= number_format($ligne['montant'], 0, ',', ' ') ?> Ar</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
