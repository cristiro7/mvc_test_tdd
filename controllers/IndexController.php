<?php

/**
 * Class Index
 * The index controller
 */
class IndexController extends \Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct('Index','index');
    }

    /**
     * Handles what happens when user moves to URL/index/index, which is the same like URL/index or in this
     * case even URL (without any controller/action) as this is the default controller-action when user gives no input.
     */
    function index()
    {
        $this->view->set('title', 'About Application');
        return $this->view->output();
    }
}
