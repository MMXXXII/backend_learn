<?php
require_once "BaseOSTwigController.php";

class ObjectController extends BaseOSTwigController
{
    public $template = "__object.twig"; 

    public function getContext(): array
    {
        $context = parent::getContext();


        // Запрос данных из базы
        $query = $this->pdo->prepare("SELECT description, image, info, id, title FROM os_list WHERE id = :my_id");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        $data = $query->fetch();

        $context['description'] = $data['description'];
        $context['image'] = $data['image'];
        $context['info'] = $data['info'];
        $context['id'] = $data['id'];

        return $context;
    }
}
