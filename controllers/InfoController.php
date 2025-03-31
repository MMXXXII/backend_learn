<?php
// require_once "WindowsInfoController.php"; // импортим TwigBaseController

class InfoController extends TwigBaseController
{
    public $template = "info.twig"; // Шаблон для информации

    public function getContext(): array
    {
        $context = parent::getContext();

        // Получаем ID объекта из параметров
        $id = $this->params['id'];

        // Запрос к базе данных для извлечения информации по ID
        $query = $this->pdo->prepare("SELECT info FROM os_list WHERE id = :my_id");
        $query->bindValue("my_id", $id);
        $query->execute();
        $data = $query->fetch();

        // Если информация найдена, передаем ее в контекст
        if ($data) {
            $context['info'] = $data['info'];
        } else {
            $context['info'] = null;
        }

        // Активная страница — информация
        $context['active_page'] = 'info';
        $context['id'] = $id;

        return $context;
    }
}
