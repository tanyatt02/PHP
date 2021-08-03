<?php


namespace app\controllers;



use app\interfaces\IRenderer;

use app\engine\App;

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
        $params['mode'] = App::call()->session->get('mode');
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}", [
                'menu' => $this->renderTemplate('menu', 
                    ['isAuth' => App::call()->userRepository->isAuth(),
                     'isReg' => AuthController::isReg(),
                    'username' => App::call()->userRepository->getName(),
                    'count' => App::call()->basketRepository->getCountWhereBasket(App::call()->userRepository->getId()),
                    'sum' => App::call()->basketRepository->getSumWhereBasket( App::call()->userRepository->getId()),
                    'isAdmin' => App::call()->userRepository->isAdmin(),
                    'error' => App::call()->session->get('error') 
                 ]),
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