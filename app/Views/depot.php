<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dépôt</title>
    <link rel="stylesheet" href="/assets/css/app-theme.css">
</head>
<body>
    <?php
    $clientRow = $client ?? [];
    if (is_array($clientRow) && isset($clientRow[0]) && is_array($clientRow[0])) {
        $clientRow = $clientRow[0];
    }
    $prefixeRow = $prefixe ?? [];
    ?>
    <div class="app-shell">
        <?= view('partials/sidebar') ?>

        <main class="app-main">
            <div class="page-grid fade-in">
                <section class="hero-panel">
                    <p class="page-kicker">Opération bancaire</p>
                    <h1 class="hero-title">Faire un dépôt</h1>
                    <p class="hero-subtitle">Ajoutez des fonds à votre compte en quelques secondes avec une interface plus lisible et plus rassurante.</p>

                    <div class="summary-grid">
                        <article class="summary-card">
                            <span class="summary-label">Client</span>
                            <div class="summary-value"><?= esc($clientRow['nom'] ?? '') ?></div>
                        </article>
                        <article class="summary-card">
                            <span class="summary-label">Solde actuel</span>
                            <div class="summary-value"><?= number_format((float) ($clientRow['solde'] ?? 0), 0, ',', ' ') ?> Ar</div>
                        </article>
                    </div>
                </section>

                <section class="form-panel">
                    <p class="page-kicker">Nouveau montant</p>
                    <h2>Encaisser un dépôt</h2>
                    <form action="/deposer" method="post" class="form-stack">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="montant_depot">Montant (Ar)</label>
                            <input type="number" id="montant_depot" name="montant" min="1" step="1" required placeholder="Ex: 5000">
                            <p class="input-hint">Le montant sera ajouté directement au solde du compte sélectionné.</p>
                        </div>
                        <div class="actions-row">
                            <button type="submit" class="btn-submit">Valider le dépôt</button>
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </div>
</body>
</html>