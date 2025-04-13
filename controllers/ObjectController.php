<?php
require_once "BaseOSTwigController.php";

class ObjectController extends BaseOSTwigController
{
    public $template = "__object.twig"; // по умолчанию

    public function getContext(): array
    {
        $context = parent::getContext();


        // Запрос данных из базы
        $query = $this->pdo->prepare("SELECT description, image, info, id FROM os_list WHERE id = :my_id");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        $data = $query->fetch();

        $context['description'] = $data['description'];
        $context['image'] = $data['image'];
        $context['info'] = $data['info'];
        $context['id'] = $data['id'];
        
        
        if (isset($_GET['show'])) {
            if ($_GET['show'] === 'image') {
                $this->template = "image.twig";
                $context['active_page'] = 'image';
            } elseif ($_GET['show'] === 'info') {
                $this->template = "info.twig";
                $context['active_page'] = 'info';
            }
        }

        return $context;
    }
}
