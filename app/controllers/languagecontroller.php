<?php
namespace MVC\Controllers;

use MVC\Lib\Helper;

class LanguageController extends AbstractController
{

    use Helper;

    public function defaultAction()
    {
        if ($_SESSION['lang'] == 'fr') {
            $_SESSION['lang'] = 'en';
        } else {
            $_SESSION['lang'] = 'fr';
        }

        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}