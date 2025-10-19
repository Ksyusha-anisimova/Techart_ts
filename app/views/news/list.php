<?php ob_start(); ?>
<header class="header">
    <div class="container">
        <div class="logo">
            <img src="/public/images/logo.png" alt="Логотип Галактический вестник" class="logo-img">
            <div class="logo-text">Галактический<br>Вестник</div>
        </div>
    </div>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</header>

<section class="hero" style="background-image: url('/public/images/<?= $this->model->safeImage($last['image']) ?>')">
    <div class="overlay"></div>
    <div class="container hero-content">
        <h1><?= htmlspecialchars($last['title']) ?></h1>
        <p><?= $this->model->safe($last['announce']) ?></p>
    </div>
</section>

<main class="container">
    <h2 class="section-title">Новости</h2>

    <div class="news-grid">
        <?php foreach ($news as $n): ?>
            <div class="news-card">
                <div class="date"><?= date('d.m.Y', strtotime($n['date'])) ?></div>
                <h3><?= htmlspecialchars($n['title']) ?></h3>
                <div><?= $this->model->safe($n['announce']) ?></div>
                <a href="?id=<?= $n['id'] ?>&page=<?= $page ?>" class="btn" aria-label="Подробнее о новости «<?= htmlspecialchars($n['title']) ?>»">Подробнее →</a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
        <?php if ($page < $pages): ?>
            <a href="?page=<?= $page + 1 ?>" class="next" aria-label="Следующая страница">→</a>
        <?php endif; ?>
    </div>
</main>

<footer class="footer">
    <div class="container">© 2025 — Галактический вестник</div>
</footer>

<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
