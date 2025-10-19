<?php
class News
{
    private $pdo;
    private const IMAGE_PATH = __DIR__ . '/../../public/images/';
    private const DEFAULT_IMAGE = 'default.jpg';

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getTotal()
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM news");
        return $stmt->fetchColumn();
    }

    public function getAll($offset, $limit)
    {
        $offset = max(0, (int)$offset);
        $limit = max(1, (int)$limit);
        $stmt = $this->pdo->prepare("SELECT * FROM news ORDER BY date DESC LIMIT :offset, :limit");
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $id = (int)$id;
        if ($id <= 0) {
            return null;
        }
        $stmt = $this->pdo->prepare("SELECT * FROM news WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getLast()
    {
        $stmt = $this->pdo->query("SELECT * FROM news ORDER BY date DESC LIMIT 1");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function safe($text)
    {
        return strip_tags($text, '<p><br><b><i><strong><em><ul><li>');
    }

    public function safeImage($filename)
    {
        $filename = basename($filename);
        $path = self::IMAGE_PATH . $filename;
        if (!file_exists($path)) {
            return self::DEFAULT_IMAGE;
        }
        return htmlspecialchars($filename, ENT_QUOTES, 'UTF-8');
    }
}
