<?php
// require_once "WindowsController.php"; // импортим TwigBaseController

class ImageController extends TwigBaseController
{
    public $template = "image.twig"; // Шаблон для изображения

    public function getContext(): array
    {
        $context = parent::getContext();

        // Получаем ID объекта из параметров
        $id = $this->params['id'];

        // Запрос к базе данных для извлечения изображения по ID
        $query = $this->pdo->prepare("SELECT image FROM os_list WHERE id = :my_id");
        $query->bindValue("my_id", $id);
        $query->execute();
        $data = $query->fetch();

        // Если картинка найдена, передаем ее в контекст
        if ($data) {
            $context['image'] = $data['image'];
        } else {
            $context['image'] = null;
        }

        // Активная страница — изображение
        $context['active_page'] = 'image';
        $context['id'] = $id;

        return $context;
    }
}
