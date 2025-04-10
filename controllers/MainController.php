<?php
require_once "BaseOSTwigController.php"; // импортим TwigBaseController

class MainController extends BaseOSTwigController
{
    public $template = "main.twig";


    public function getContext(): array
    {
        $context = parent::getContext();

        if (isset($_GET['type'])) {
            $query = $this->pdo->prepare("SELECT * FROM os_list WHERE type = :type");
            $query->bindValue(':type', $_GET['type']);
            $query->execute();
        } else {
            $query = $this->pdo->query("SELECT * FROM os_list");
        }
        $context['os_list'] = $query->fetchAll();

        return $context;
    }
}
