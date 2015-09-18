<?php
/**
 * Class Application
 * Takes the parts of the URL and loads the according controller & method and passes the parameter arguments to it
 */
class Application
{
    /** @var null The controller part of the URL */
    private $url_controller;
    /** @var null The model part of the URL */
    private $url_model;
    /** @var null The method part (of the above controller) of the URL */
    private $url_action;
    /** @var null Parameter one of the URL */
    private $url_parameter_1;
    /** @var null Parameter two of the URL */
    private $url_parameter_2;
    /** @var null Parameter three of the URL */
    private $url_parameter_3;

    /**
     * Starts the Application
     * Get rid of deep if/else nesting
     */
    public function __construct()
    {
        $this->splitUrl();
        // check for controller: is the url_controller NOT empty ?
        if ($this->url_controller)
        {
            // check for controller: does such a controller exist ?
            if (file_exists(CONTROLLERS_PATH . $this->url_controller . '.php'))
            {
                // if so, create this controller
                $this->url_controller = new $this->url_controller($this->url_model, $this->url_action);
                
                // check for method: does such a method exist in the controller ?
                if ($this->url_action)
                {
                    if (method_exists($this->url_controller, $this->url_action))
                    {
                        // call the method and pass the arguments to it
                        if (isset($this->url_parameter_3))
                        {
                            $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2, $this->url_parameter_3);
                        }
                        else if (isset($this->url_parameter_2))
                        {
                            $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2);
                        }
                        else if (isset($this->url_parameter_1))
                        {
                            $this->url_controller->{$this->url_action}($this->url_parameter_1);
                        }
                        else
                        {
                            // if no parameters given, just call the method without arguments
                            $this->url_controller->{$this->url_action}();
                        }
                    }
                    else
                    {
                        // redirect user to error page (there's a controller for that)
                        header('location: ' . BASE_PATH . 'error/index');
                    }
                } else {
                    // default/fallback: call the index() method of a selected controller
                    $this->url_controller->index();
                }
            // obviously mistyped controller name, therefore show 404
            } 
            else
            {
                // redirect user to error page (there's a controller for that)
                header('location: ' . BASE_PATH . 'error/index');
            }
        // if url_controller is empty, simply show the main page (index/index)
        }
        else
        {
            // invalid URL, so simply show home/index
            require CONTROLLERS_PATH . 'EmployeesController.php';
            $controller = new EmployeesController('Employees','index');
            $controller->index();
        }
    }

    /**
     * Gets and splits the URL
     */
    private function splitUrl()
    {
        if (isset($_GET['url']))
        {
            // split URL
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // Put URL parts into according properties
            $this->url_controller  = (isset($url[0]) ? ucwords($url[0]).'Controller' : null);
            $this->url_model       = (isset($url[0]) ? ucwords($url[0]) : null);
            $this->url_action      = (isset($url[1]) ? $url[1] : 'index');
            $this->url_parameter_1 = (isset($url[2]) ? $url[2] : null);
            $this->url_parameter_2 = (isset($url[3]) ? $url[3] : null);
            $this->url_parameter_3 = (isset($url[4]) ? $url[4] : null);
        }
    }
}
