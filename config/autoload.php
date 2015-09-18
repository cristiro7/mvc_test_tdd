<?php

/**
 * The auto-loading function, which will be called every time a file "is missing"
 */
function autoload($class) {
    // if file does not exist in LIBRARY_PATH folder [set it in config/config.php]
    if (file_exists(LIBRARY_PATH . $class . ".php")) {
        require_once LIBRARY_PATH . $class . ".php";
    }
    // if file does not exist in MODELS_PATH folder [set it in config/config.php] 
    else if (file_exists(MODELS_PATH . $class . ".php"))
	{
		require_once MODELS_PATH . $class . ".php";
	}
    // if file does not exist in CONTROLLERS_PATH folder [set it in config/config.php] 
    else if (file_exists(CONTROLLERS_PATH . $class . ".php"))
	{
		require_once CONTROLLERS_PATH . $class . ".php";
	}
    else {
        exit ('The file ' . $class . '.php is missing in the folder.');
    }
}

// spl_autoload_register defines the function that is called every time a file is missing. as we created this
// function above, every time a file is needed, autoload(THENEEDEDCLASS) is called
spl_autoload_register("autoload");
