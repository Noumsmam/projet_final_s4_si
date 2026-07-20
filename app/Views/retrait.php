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

        /* Alignement du contenu principal au centre de la page */
        .main-content {
            margin-left: 240px; /* Conserve l'espace pour la sidebar */
            min-height: 100vh;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center; /* Centrage vertical */
            align-items: center;     /* Centrage horizontal */
        }

        .user-header {
            text-align: center;
            margin-bottom: 1rem;
        }

        .user-header h1 {
            font-size: 1.75rem;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .user-header p {
            color: #64748b;
            margin-bottom: 0.25rem;
        }

        .section {
            width: 100%;
            max-width: 420px;
            padding: 1.5rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
        }

        .section h2 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            text-align: center;
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
            width: 100%;
            padding: 0.61rem;
            background: #1e293b;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background: #334155;
        }
    </style>
</head>
<body>
    <?= view('partials/sidebar') ?>

    <main class="main-content">
        <!-- Informations d'en-tête centrées -->
        <div class="user-header">
            <h1>Bonjour, <?= esc($client[0]['nom']) ?>!</h1>
            <p>N° <?= esc($prefixe['num']) ?><?= esc($client[0]['num']) ?></p>
            <p>Votre solde actuel est : <strong><?= number_format($client[0]['solde'], 0, ',', ' ') ?> Ar</strong></p>
        </div>

        <!-- Formulaire de retrait centré -->
        <section class="section" id="retrait">
            <?php if (isset($error)){ ?>
                <div class="alert alert-danger">
                    <?= esc($error) ?>
                </div>
            <?php } ?>
            <h2>Faire un retrait</h2>
            <form action="/retrait" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="montant_retrait">Montant (Ar)</label>
                    <input type="number" id="montant_retrait" name="montant" min="1" step="1" required placeholder="Ex: 5000">
                </div>
                <button type="submit" class="btn-submit">Valider</button>
            </form>
        </section>
    </main>
</body>
</html>