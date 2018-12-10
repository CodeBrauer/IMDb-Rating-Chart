<?php
namespace IMDBRC;

class View
{
    public static function load($view, $data = [])
    {
        extract($data);
        ob_start();
        require __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $view . '.php';
        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }
}