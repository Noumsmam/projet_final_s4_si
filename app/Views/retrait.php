<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrait</title>
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
                    <h1 class="hero-title">Faire un retrait</h1>
                    <p class="hero-subtitle">Retirez un montant avec une vue plus lisible et un retour d’erreur clairement visible si le solde ne suffit pas.</p>

                    <div class="summary-grid">
                        <article class="summary-card">
                            <span class="summary-label">Compte</span>
                            <div class="summary-value"><?= esc($prefixeRow['num'] ?? '') ?><?= esc($clientRow['num'] ?? '') ?></div>
                        </article>
                        <article class="summary-card">
                            <span class="summary-label">Solde disponible</span>
                            <div class="summary-value"><?= number_format((float) ($clientRow['solde'] ?? 0), 0, ',', ' ') ?> Ar</div>
                        </article>
                    </div>
                </section>

                <section class="form-panel">
                    <p class="page-kicker">Retrait sécurisé</p>
                    <h2>Prélever un montant</h2>
                    <?php if (isset($error)){ ?>
                        <div class="alert alert-danger">
                            <?= esc($error) ?>
                        </div>
                    <?php } ?>
                    <?php if (session()->getFlashdata('success')) { ?>
                        <div class="alert alert-success">
                            <?= esc(session()->getFlashdata('success')) ?>
                        </div>
                    <?php } ?>
                    <form action="/retrait" method="post" class="form-stack">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="montant_retrait">Montant (Ar)</label>
                            <input type="number" id="montant_retrait" name="montant" min="1" step="1" required placeholder="Ex: 5000">
                            <p class="input-hint">Le montant retiré sera débité du compte après contrôle du solde et des frais.</p>
                        </div>
                        <div class="actions-row">
                            <button type="submit" class="btn-submit">Valider le retrait</button>
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </div>
</body>
</html>