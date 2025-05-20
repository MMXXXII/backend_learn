<?php
require_once "BaseOSTwigController.php";


class OperationSystemsUpdateController extends BaseOSTwigController
{

    public $template = "opeartion_systems_create.twig";

    public function get(array $context)
{
    $id = $this->params['id'];

    $sql = <<<EOL
SELECT * FROM os_list WHERE id = :id
EOL;

    $query = $this->pdo->prepare($sql);
    $query->bindValue(":id", $id);
    $query->execute();

    $data = $query->fetch();
    $context['object'] = $data;

    parent::get($context); 
}


public function post(array $context) {
    $id = $this->params['id'];

    $title = $_POST['title'];
    $description = $_POST['description'];
    $type = $_POST['os_type'];
    $info = $_POST['info'];

    $image_url = null;

    if (!empty($_FILES['image']['tmp_name'])) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name";
    }

    $sql = "UPDATE os_list SET title = :title, description = :description, type = :type, info = :info";
    if ($image_url !== null) {
        $sql .= ", image = :image_url";
    }
    $sql .= " WHERE id = :id";

    $query = $this->pdo->prepare($sql);
    $query->bindValue(":title", $title);
    $query->bindValue(":description", $description);
    $query->bindValue(":type", $type);
    $query->bindValue(":info", $info);
    if ($image_url !== null) {
        $query->bindValue(":image_url", $image_url);
    }
    $query->bindValue(":id", $id);
    $query->execute();

    $context['message'] = "Объект обновлён!";
    $context['id'] = $id;

    $this->get($context); // чтобы перезагрузить форму с обновлёнными данными
}

}
