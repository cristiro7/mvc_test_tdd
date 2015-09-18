<?php

/**
 * Class Error
 * This controller simply shows a page that will be displayed when a controller/method is not found.
 * Simple 404 handling.
 */
class ErrorController extends Controller
{
    /**
     * This method controls what happens / what the user sees when an error happens (404)
     */
    function index()
    {
        $this->view->set('title', 'Error 404');
        
        // show the view
        return $this->view->output();
    }
}
