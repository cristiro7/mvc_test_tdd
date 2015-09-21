<?php
/**
 * This is the "base controller class". All other "real" controllers extend this class.
 * Whenever a controller is created, we also
 * 1. create a view object
 * 2. create a model object
 */
class Controller
{
    protected $model;
    protected $controller;
    protected $action;
    protected $view;
    protected $modelBaseName;

    public function __construct($model, $action)
    {
        // Initialize a session
        Session::init();
        
        $this->controller = ucwords(__CLASS__);
        $this->action = $action;
        $this->modelBaseName = $model;
        $this->view = new View(HOME . DS . 'views' . DS . strtolower($this->modelBaseName) . DS . $action . '.tpl');
    }

    /**
     * set the model with the given name.
     * @param $modelName string name of the model
     */
    protected function setModel($modelName)
    {
        $modelName .= 'Model';
        $this->model = new $modelName();
    }
    
    /**
     * set the view with the given name.
     * @param $viewName string name of the view
     */
    protected function setView($viewName)
    {
        $this->view = new View(HOME . DS . 'views' . DS . strtolower($this->modelBaseName) . DS . $viewName . '.tpl');
    }
}
