<?php

namespace MVC\Controllers;


use MVC\LIB\FrontController;


class AbstractController
{

    const NOT_FOUND_ACTION ='notFoundAction';
    protected $_controller ;
    protected $_action ;
    protected $_params ;


    protected $_template;
    protected $_registry;

    protected $_data = [];


    public function __get($key)
    {
        return $this->_registry->$key;
    }

    public function notFoundAction()
    {
        $this->_view();
    }

    public function setController ($controllerName)
    {
        $this->_controller = $controllerName;
    }

    public function setAction ($actionName)
    {
        $this->_action = $actionName;
    }

    public function setTemplate($template)
    {
        $this->_template = $template;
    }

    public function setRegistry($registry)
    {
        $this->_registry = $registry;
    }

    public function setParams ($params)
    {
        $this->_params = $params;
    }


    protected  function _view(){



        $view =  VIEWS_PATH.DS.$this->_controller.DS.$this->_action.'.view.php';


        if($this->_action == FrontController::NOT_FOUND_ACTION || !file_exists($view)){

            $view = VIEWS_PATH.DS.'notfound'.DS.'notfound.view.php';

        }
            $this->_data = array_merge($this->_data,$this->language->getDictionary());
            //extract($this->_data);
            $this->_template->setRegistry($this->_registry);
            $this->_template->setActionViewFile($view);
            $this->_template->setAppData($this->_data);
            $this->_template->renderApp();


    }




}