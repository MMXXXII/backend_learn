<?php

class ObjectController extends TwigBaseController
{
    public $template = "__object.twig"; // указываем шаблон

    public function getContext(): array
    {
        $context = parent::getContext();

        // Определяем, что нужно вывести: описание или изображение
        $type = isset($this->params['type']) ? $this->params['type'] : 'info';

        // Запрос в базу данных для получения данных
        $query = $this->pdo->prepare("SELECT title, description, image, info FROM os_list WHERE id = :my_id");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        $data = $query->fetch();
        $context['system'] = $data;

        if ($type === 'info') {
            // Для 'info' передаем описание
            $context['info'] = $data['info'];
        } elseif ($type === 'image') {
            // Для 'image' передаем изображение
            $context['image'] = $data['image'];
        }

        return $context;
    }
}

