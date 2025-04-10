<?php
require_once "BaseOSTwigController.php"; // импортим TwigBaseController

class MainController extends BaseOSTwigController
{
    public $template = "main.twig";


    public function getContext(): array
    {
        $context = parent::getContext();

        if (isset($_GET['type'])) {
            $stmt = $this->pdo->prepare("SELECT * FROM os_list WHERE type = :type");
            $stmt->bindValue(':type', $_GET['type']);
            $stmt->execute();
        } else {
            $stmt = $this->pdo->query("SELECT * FROM os_list");
        }
        $context['os_list'] = $stmt->fetchAll();

        return $context;
    }
}
