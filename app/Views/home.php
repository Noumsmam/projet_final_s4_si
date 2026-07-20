<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Solde & Opérations</title>
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

        /* Utilisation de flexbox pour centrer le contenu au milieu de l'écran */
        .main-content {
            margin-left: 240px;
            padding: 2rem;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dashboard-card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .user-info {
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 1rem;
        }

        .user-info h1 {
            font-size: 1.5rem;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .user-info .phone {
            color: #64748b;
            font-size: 0.95rem;
        }

        .balance-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1.5rem 1rem;
            text-align: center;
        }

        .balance-box label {
            display: block;
            font-size: 0.875rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .balance-box .amount {
            font-size: 2.2rem;
            font-weight: bold;
            color: #0f172a;
        }
    </style>
</head>
<body>
    <?= view('partials/sidebar') ?>

    <main class="main-content">
        <div class="dashboard-card">
            
            <!-- Informations Client -->
            <div class="user-info">
                <h1>Bonjour, <?= esc($client[0]['nom']) ?> !</h1>
                <p class="phone">N° <?= esc($prefixe['num']) ?><?= esc($client[0]['num']) ?></p>
            </div>

            <!-- Solde Centralisé -->
            <div class="balance-box">
                <label>Solde actuel</label>
                <div class="amount"><?= number_format($client[0]['solde'], 0, ',', ' ') ?> Ar</div>
            </div>

        </div>
    </main>
</body>
</html>