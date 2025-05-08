<?php
require_once "BaseOSTwigController.php";

class ObjectController extends BaseOSTwigController
{
    public $template = "__object.twig"; 

    public function getContext(): array
    {
        $context = parent::getContext();

        // Запрос данных из базы
        $query = $this->pdo->prepare("SELECT description, image, info, id, title FROM os_list WHERE id = :my_id");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        $data = $query->fetch();

        // Если данные не найдены, перенаправляем на страницу 404
        if (!$data) {
            header("Location: /404");
            exit;
        }

        // Если данные найдены, заполняем контекст
        $context['description'] = $data['description'] ?? "Описание не найдено";
        $context['image'] = $data['image'] ?? "";
        $context['info'] = $data['info'] ?? "";
        $context['id'] = $data['id'];
        $context['title'] = $data['title'] ?? "Без названия";

        $context["my_session_message"] = $_SESSION['welcome_message'] ?? "";
        $context["messages"] = $_SESSION['messages'] ?? [];
        $context["history"] = $_SESSION['history'] ?? [];

        return $context;
    }
}
