<?php
namespace MVC\Controllers;

use MVC\Lib\Validate;
use MVC\Models\UserModel;

class TestController extends AbstractController
{
    use Validate;
    public function defaultAction()
    {

        $var= UserModel::get('select count(*) as UserId from '.UserModel::getModelTableName());

        echo $var[0]->UserId;


    }
}