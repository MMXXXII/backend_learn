<?php
require_once "BaseOSTwigController.php"; // импортим TwigBaseController

class ObjectController extends BaseOSTwigController
{
    public $template = "__object.twig"; 

    public function getContext(): array
    {
        $context = parent::getContext();


        $query = $this->pdo->prepare("SELECT description, image, info, id FROM os_list WHERE id = :my_id");
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
