<?php 

$view_folder = '';

// The path to the "views" folder

    if ( ! is_dir($view_folder))
    {
        if ( ! empty($view_folder) && is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR))
        {
            $view_folder = APPPATH.$view_folder;
        }
        elseif ( ! is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
        {
            header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
            echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
            exit(3); // EXIT_CONFIG
        }
        else
        {
            $view_folder = APPPATH.'views';
        }
    }

    if (($_temp = realpath($view_folder)) !== FALSE)
    {
        $view_folder = $_temp.DIRECTORY_SEPARATOR;
    }
    else
    {
        $view_folder = rtrim($view_folder, '/\\').DIRECTORY_SEPARATOR;
    }

    define('VIEWPATH', $view_folder);