<?php
require_once __DIR__ . '/../models/News.php';

class NewsController
{
    private $model;
    private const NEWS_PER_PAGE = 4;

    public function __construct($pdo)
    {
        $this->model = new News($pdo);
    }

    public function list($page = 1)
    {
        $page = max(1, (int)$page);
        $total = $this->model->getTotal();
        $pages = ceil($total / self::NEWS_PER_PAGE);
        $page = min($page, $pages);
        $offset = ($page - 1) * self::NEWS_PER_PAGE;
        $news = $this->model->getAll($offset, self::NEWS_PER_PAGE);
        $last = $this->model->getLast();
        include __DIR__ . '/../views/news/list.php';
    }

    public function detail($id)
    {
        $id = (int)$id;
        if ($id <= 0) {
            http_response_code(400);
            echo 'Некорректный ID';
            return;
        }
        $item = $this->model->getById($id);
        if (!$item) {
            http_response_code(404);
            echo 'Новость не найдена';
            return;
        }
        include __DIR__ . '/../views/news/detail.php';
    }
}
