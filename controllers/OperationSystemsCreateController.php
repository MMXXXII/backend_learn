<?php
require_once "BaseOSTwigController.php";

class OperationSystemsCreateController extends BaseOSTwigController {
    public $template = "opeartion_systems_create.twig";

    public function get($context) // добавили параметр
    {
        
        parent::get($context); // пробросили параметр
    }

    public function post($context) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];
        
        // вытащил значения из $_FILES
        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name"; // формируем ссылку без адреса сервера

        $sql = <<<EOL
INSERT INTO os_list(title, description, type, info, image)
VALUES(:title, :description, :type, :info, :image_url)
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url); // подвязываем значение ссылки к переменной  image_url
        $query->execute();
        
        // а дальше как обычно
        $context['message'] = 'Вы успешно создали объект';
        $context['id'] = $this->pdo->lastInsertId();

        $this->get($context);
    }
}