<?php
require_once "BaseOSTwigController.php";

class SearchController extends BaseOSTwigController
{
    public $template = "search.twig"; // по умолчанию

    public function getContext(): array
    {
        $context = parent::getContext();

        $type = isset($_GET['object_type']) ? $_GET['object_type'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';


        $sql = <<<EOL
SELECT id, title
FROM os_list
WHERE (:title = '' OR title LIKE CONCAT('%', :title, '%'))
    AND (:type = '' OR type = :type)
EOL;

        $query = $this->pdo->prepare($sql);

        $query->bindValue("title", $title);
        $query->bindValue("type", $type);
        $query->execute();

        $context['os_list'] = $query->fetchAll();
var_dump($title, $type, $context['os_list']);

        return $context;
    }
}
