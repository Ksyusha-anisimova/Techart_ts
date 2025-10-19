<?php ob_start(); ?>
<header class="header border-detail">
    <div class="container">
        <div class="logo">
            <img src="/public/images/logo.png" alt="Логотип Галактический вестник" class="logo-img">
            <div class="logo-text">Галактический<br>Вестник</div>
        </div>
    </div>
</header>

<main class="container detail-page">
    <p class="breadcrumb">Главная / <?= htmlspecialchars($item['title']) ?></p>
    <h1><?= htmlspecialchars($item['title']) ?></h1>

    <div class="detail-content">
        <div class="detail-text">
            <p class="date"><?= date('d.m.Y', strtotime($item['date'])) ?></p>
            <div class="subtitle"><?= $this->model->safe($item['announce']) ?></div>
            <div class="content"><?= $this->model->safe($item['content']) ?></div>
            <a href="/?page=<?= isset($_GET['page']) ? intval($_GET['page']) : 1 ?>" class="btn back">← Назад к новостям</a>
        </div>

        <div class="detail-image">
            <img src="/public/images/<?= $this->model->safeImage($item['image']) ?>" alt="Иллюстрация к новости «<?= htmlspecialchars($item['title']) ?>»">
        </div>
    </div>
</main>

<footer class="footer">
    <div class="container">© 2025 — Галактический вестник</div>
</footer>

<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
