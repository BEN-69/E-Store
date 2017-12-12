<?php

namespace MVC\Controllers;

class AccessDeniedController extends AbstractController
{
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->_view();
    }
}