<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
        }

        .main-content {
            margin-left: 240px;
            padding: 2rem;
        }

        .logout-link {
            display: inline-block;
            margin-top: 1rem;
            color: #dc2626;
            text-decoration: none;
        }

        .logout-link:hover {
            text-decoration: underline;
        }

        .section {
            margin-top: 2rem;
            padding: 1.5rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
            max-width: 420px;
        }

        .section h2 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.35rem;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 0.6rem 0.75rem;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 1rem;
        }

        .btn-submit {
            padding: 0.6rem 1.25rem;
            background: #1e293b;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: #334155;
        }
    </style>
</head>
<body>
    <?= view('partials/sidebar') ?>

    <main class="main-content">

        <h1>Bonjour, <?= esc($client[0]['nom']) ?>!</h1>
        <p>Numero : <?= esc($prefixe['num']) ?><?= esc($client[0]['num']) ?></p>
        <p>Votre solde actuel est : <strong><?= esc($client[0]['solde']) ?> Ar</strong></p>

        <section class="section" id="depot">
            <h2>Faire un dépôt</h2>
            <form action="/deposer" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="montant_depot">Montant (Ar)</label>
                    <input type="number" id="montant_depot" name="montant" min="1" step="1" required>
                </div>
                <button type="submit" class="btn-submit">Valider</button>
            </form>
        </section>

        <section class="section" id="retrait">
            <h2>Faire un retrait</h2>
            <form action="/retrait" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="montant_retrait">Montant (Ar)</label>
                    <input type="number" id="montant_retrait" name="montant" min="1" step="1" required>
                </div>
                <button type="submit" class="btn-submit">Valider</button>
            </form>
        </section>
    </main>
</body>
</html>
