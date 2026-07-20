<style>
    .fixed-menu {
        position: fixed;
        top: 0;
        left: 0;
        width: 240px;
        height: 100vh;
        background: #1e293b;
        color: #fff;
        padding: 1.5rem 0;
        box-shadow: 2px 0 8px rgba(0, 0, 0, 0.15);
    }

    .fixed-menu h2 {
        font-size: 1.1rem;
        font-weight: 600;
        padding: 0 1.25rem 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        margin-bottom: 0.5rem;
    }

    .fixed-menu ul {
        list-style: none;
    }

    .fixed-menu li {
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .fixed-menu a {
        display: block;
        padding: 0.85rem 1.25rem;
        color: #e2e8f0;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }

    .fixed-menu a:hover {
        background: #334155;
        color: #fff;
    }

    .fixed-menu a::before {
        content: "◦ ";
        color: #94a3b8;
    }
</style>

<nav class="fixed-menu">
    <h2>Menu</h2>
    <ul>
        <li><a href="/home">Voir le solde</a></li>
        <li><a href="/depot">Faire un dépôt</a></li>
        <li><a href="/retrait">Faire un retrait</a></li>
        <li><a href="/transfert">Faire un transfert</a></li>
        <li><a href="/historique">Voir les historiques</a></li>
        <li><a href="/logout">Se déconnecter</a></li>
    </ul>
</nav>
