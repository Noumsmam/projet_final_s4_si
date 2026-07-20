<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $client ? 'Modifier un client' : 'Nouveau client' ?></title>
    <link rel="stylesheet" href="/assets/css/app-theme.css">
    <style>
        .admin-main {
            margin-left: 0;
            align-items: flex-start;
            padding-top: 48px;
        }

        .admin-panel {
            width: 100%;
            max-width: 640px;
            border: 1px solid rgba(220, 230, 213, 0.95);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.92);
            box-shadow: var(--shadow-soft);
            padding: 28px;
        }
    </style>
</head>
<body>
    <?php
    $isEdit = !empty($client);
    $fieldValue = static function (string $field, $default = '') use ($client) {
        $fallback = is_array($client) ? ($client[$field] ?? $default) : $default;
        return esc(old($field, $fallback));
    };
    $selectedPrefixe = static function (int $prefixeId) use ($client) {
        $current = old('id_prefixe', is_array($client) ? ($client['id_prefixe'] ?? '') : '');
        return (string) $current === (string) $prefixeId ? 'selected' : '';
    };
    ?>
    <div class="app-shell">
        <main class="app-main admin-main">
            <section class="admin-panel fade-in">
                <p class="page-kicker">Administration</p>
                <h1 class="hero-title" style="font-size: 2rem;"><?= $isEdit ? 'Modifier un client' : 'Nouveau client' ?></h1>
                <p class="hero-subtitle"><?= $isEdit ? 'Mettez à jour les informations du compte client.' : 'Créez un nouveau compte client.' ?></p>

                <?php if (session()->getFlashdata('error')) { ?>
                    <div class="alert alert-danger">
                        <?= esc(session()->getFlashdata('error')) ?>
                    </div>
                <?php } ?>

                <form action="<?= esc($action) ?>" method="post" class="form-stack" style="margin-top: 1.5rem;">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" value="<?= $fieldValue('nom') ?>" required placeholder="Ex: Rakoto Jean">
                    </div>
                    <div class="form-group">
                        <label for="id_prefixe">Préfixe</label>
                        <select id="id_prefixe" name="id_prefixe" required>
                            <option value="">Choisir un préfixe</option>
                            <?php foreach ($prefixes as $prefixe) : ?>
                                <option value="<?= esc($prefixe['id']) ?>" <?= $selectedPrefixe((int) $prefixe['id']) ?>>
                                    <?= esc($prefixe['num']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="num">Numéro client</label>
                        <input type="text" id="num" name="num" value="<?= $fieldValue('num') ?>" required placeholder="Ex: 1234567">
                        <p class="input-hint">Numéro unique du client, sans le préfixe.</p>
                    </div>
                    <div class="form-group">
                        <label for="solde">Solde (Ar)</label>
                        <input type="number" id="solde" name="solde" min="0" step="1" value="<?= $fieldValue('solde', 0) ?>" required placeholder="Ex: 10000">
                    </div>
                    <div class="actions-row">
                        <a href="/gestion-clients" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn-submit"><?= $isEdit ? 'Enregistrer' : 'Créer le client' ?></button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
