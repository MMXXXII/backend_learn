<?php
require_once "BaseOSTwigController.php";

class OperationSystemsTypeController extends BaseOSTwigController {
    public $template = "types.twig"; // можно сделать отдельный шаблон, если хочешь

    public function post($context) {
        // Получаем данные из формы
        $type_name = $_POST['title'];
        
        // Проверка обязательных полей
        if (!$type_name) {
            $context['message'] = "Название и описание обязательны для заполнения.";
            $this->get($context);
            return;
        }

        // Проверка наличия картинки
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            move_uploaded_file($tmp_name, "../public/media/$name");
            $picture_url = "/media/$name";
        } else {
            $picture_url = null; // если картинки нет, сохраняем null
        }

        // Вставка данных в базу
        $sql = <<<EOL
    INSERT INTO os_types(type_name, picture)
    VALUES(:type_name, :picture)
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("type_name", $type_name);
        $query->bindValue("picture", $picture_url);
        $query->execute();

        $this->get($context);
    }

    public function get($context) {
        parent::get($context);
    }
}
