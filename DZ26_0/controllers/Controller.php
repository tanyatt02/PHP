<?php


namespace app\controllers;



use app\interfaces\IRenderer;
use app\models\{User, Basket};

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $layout = 'main';
    private $useLayout = true;

    private $render;


    public function __construct(IRenderer $render)
    {
        $this->render = $render;
    }


    public function runAction($action) {
        $this->action = $action ?? $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            die("экшен не существует");
        }
    }


    protected function render($template, $params = []) {
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}", [
                'menu' => $this->renderTemplate('menu', 
                    ['isAuth' => User::isAuth(),
                    'username' => User::getName(),
                    'count' => Basket::getCountWhere('user_id', User::getId()),
                    'sum' => Basket::getSumWhere('user_id', User::getId())]),
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    protected function renderTemplate($template, $params = []) {
        return $this->render->renderTemplate($template, $params);

    }
}