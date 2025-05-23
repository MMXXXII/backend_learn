<?php
require_once "BaseController.php"; // обязательно импортим BaseController

class TwigBaseController extends BaseController
{
    public $title = ""; // название страницы
    public $template = ""; // шаблон страницы
    protected \Twig\Environment $twig; // ссылка на экземпляр twig, для рендернига

    // теперь пишем конструктор, 
    // передаем в него один параметр
    // собственно ссылка на экземпляр twig
    // это кстати Dependency Injection называется
    // это лучше чем создавать глобальный объект $twig 
    // и быстрее чем создавать персональный $twig обработчик для каждого класс 
    public function setTwig($twig)
    {
        $this->twig = $twig;
    }

    // переопределяем функцию контекста
    // Переопределение метода getContext для добавления active_page
    public function getContext(): array
{
    
    $context = parent::getContext();
    $context['title'] = $this->title;

    $currentPage = $_GET['show'] ?? '';
    $context['active_page'] = $currentPage;

    // Добавим информацию о пользователе
    $context['user'] = [
        'is_authenticated' => isset($_SESSION['user']),
        'username' => $_SESSION['user']['username'] ?? null
    ];

    return $context;
}



    // функция гет, рендерит результат используя $template в качестве шаблона
    // и вызывает функцию getContext для формирования словаря контекста


    public function get(array $context){
        if (isset($_GET['show'])) {
            if ($_GET['show'] === 'image') {
                $this->template = "image.twig";
            } elseif ($_GET['show'] === 'info') {
                $this->template = "info.twig";
            }
        }
        echo $this->twig->render($this->template, $context);
    }

}


