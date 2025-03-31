<?php

class ObjectController extends TwigBaseController
{
    public $template = "__object.twig"; // указываем шаблон

    public function getContext(): array
    {
        $context = parent::getContext();

        // Запрос для извлечения описания, картинки и информации по ID
        $query = $this->pdo->prepare("SELECT description, image, info FROM os_list WHERE id = :my_id");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        // Извлекаем данные
        $data = $query->fetch();

        // Передаем описание, картинку и информацию в контекст
        $context['description'] = $data['description'];
        $context['image'] = $data['image'];
        $context['info'] = $data['info'];

        return $context;
    }
}
