<?php

class BaseOSTwigController extends TwigBaseController
{

    public function getContext(): array
    {
        $context = parent::getContext();
        // создаем запрос к БД
        $query = $this->pdo->query("SELECT DISTINCT type FROM os_list ORDER BY 1");
        // стягиваем данные
        $types = $query->fetchAll();
        // создаем глобальную переменную в $twig, которая будет достпна из любого шаблона
        $context['types'] = $types;

        $sql = "SELECT * FROM os_types";
        $types = $this->pdo->query($sql)->fetchAll();
        $context['types'] = $types;


        return $context;
    }
}
