<?php

/**
 * Class View
 *
 * Provides the methods all views will have
 */
class View
{
    // View file to include
    protected $file;
    // View data array
    protected $data = array();

    /**
     * Constructor
     *
     * @param string $file file to include
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /** Set Variables **/
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /** Get Variables **/
    public function get($key)
    {
        return $this->data[$key];
    }

    /** Display template **/
    public function output()
    {
        // Check for tempalte: does such a tempalte file exist in the view folder ?
        if (!file_exists($this->file))
        {
            throw new Exception("View " . $this->file . " doesn't exist.");
        }

        extract($this->data);
        ob_start();
        // Load layout header
        include HOME . DS . 'layout' . DS . 'header.php';
        // Load content
        include($this->file);
        // Load layout footer
        include HOME . DS . 'layout' . DS . 'footer.php';
        $output = ob_get_contents();
        
        // Ignore view output
        ob_end_clean();
        echo $output;
    }
}
