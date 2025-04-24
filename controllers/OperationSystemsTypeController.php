<?php
require_once "BaseOSTwigController.php";

class OperationSystemsTypeController extends BaseOSTwigController {
    public $template = "types.twig"; // можно сделать отдельный шаблон, если хочешь

    public function post($context) {
        $type_name = $_POST['title'];
    
        // Проверка обязательных полей
        if (!$type_name) {
            $context['message'] = "Название обязательно для заполнения.";
            $this->get($context);
            return;
        }
    
        // Проверка наличия картинки
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            $context['message'] = "Пожалуйста, загрузите картинку.";
            $this->get($context);
            return;
        }
    
        // Сохраняем файл
        $tmp_name = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $picture_url = "/media/$name";
    
        // Вставка в БД
        $sql = <<<EOL
            INSERT INTO os_types(type_name, picture)
            VALUES(:type_name, :picture)
        EOL;
    
        $query = $this->pdo->prepare($sql);
        $query->bindValue("type_name", $type_name);
        $query->bindValue("picture", $picture_url);
        $query->execute();
    
        $context['message'] = "Тип успешно добавлен.";
        $this->get($context);
    }
    

    public function get($context) {
        parent::get($context);
    }
}
