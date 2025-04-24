<?php
require_once "BaseOSTwigController.php";

class SearchController extends BaseOSTwigController
{
    public $template = "search.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        // Получаем параметры из GET-запроса
        $type = isset($_GET['os_type']) ? $_GET['os_type'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $info = isset($_GET['info']) ? $_GET['info'] : '';

        // Получаем все типы из os_types для отображения в форме
        $sql = "SELECT * FROM os_types";
        $types = $this->pdo->query($sql)->fetchAll();
        $context['types'] = $types;

        // SQL-запрос с фильтрацией по выбранным параметрам
        $sql = <<<EOL
SELECT id, title
FROM os_list
WHERE (:title = '' OR title LIKE CONCAT('%', :title, '%'))
    AND (:type = '' OR type = :type)
    AND (:info = '' OR info LIKE CONCAT('%', :info, '%'))
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->execute();

        // Получаем список ОС, подходящих под фильтры
        $context['os_list'] = $query->fetchAll();

        // Добавляем переменные для поиска в контекст, чтобы передавать их в шаблон
        $context['os_type'] = $type;
        $context['title'] = $title;
        $context['info'] = $info;

        return $context;
    }
}
