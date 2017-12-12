<?php
namespace MVC\Controllers;

use MVC\Lib\Messenger;
use MVC\Models\ExpenseCategoryModel;
use MVC\Lib\Validate;
use MVC\Lib\InputFilter;
use MVC\Lib\Helper;

class ExpensesCategoriesController extends AbstractController
{
    use Validate;
    use InputFilter;
    use Helper;

    protected $_createActionRoles = [
        'ExpenseName'      =>   'req|alphanum|between(2,30)',
        'FixedPayment'     =>   'req|num|between(2,10)'
    ];

    public function defaultAction()
    {
        $this->_data['categories'] = ExpenseCategoryModel::getAll();
        $this->language->load('template.common');
        $this->language->load('expensescategories.default');
        $this->language->load('expensescategories.labels');




       // $this->injectDataTable();
        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('expensescategories.create');
        $this->language->load('expensescategories.labels');
        $this->language->load('expensescategories.messages');
        $this->language->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST) ) {
           /* if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->redirect('/expensescategories');
                }
           */
                $category = new ExpenseCategoryModel();
                $category->ExpenseName = $this->filterString($_POST['ExpenseName']);
                $category->FixedPayment = $this->filterFloat($_POST['FixedPayment']);
                if($category->save()) {
                    $this->messenger->add($this->language->get('message_create_success'));
                    $this->redirect('/expensescategories');
                };
           // }
        }

        $this->_view();
    }

    public function editAction()
    {

        if(isset($this->_params[0])){

            $id = $this->filterInt($this->_params[0]);

        }else{

            $this->redirect('/expensescategories');
        }

        $category = ExpenseCategoryModel::getByPK($id);
        if($category === false) {
            $this->redirect('/expensescategories');
        }

        $this->_data['category'] = $category;

        $this->language->load('template.common');
        $this->language->load('expensescategories.edit');
        $this->language->load('expensescategories.labels');
        $this->language->load('expensescategories.messages');
        $this->language->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {
            /*if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->redirect('/expensescategories');
                }
            */


            $category->ExpenseName = $this->filterString($_POST['ExpenseName']);
            $category->FixedPayment = $this->filterFloat($_POST['FixedPayment']);


            if($category->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/expensescategories');


          //  }
        }

        $this->_view();
    }

    public function deleteAction()
    {
       /* if(!$this->requestHasValidToken($_GET['token'])) {
            $this->redirect('/expensescategories');
        }*/

        if(isset($this->_params[0])){

            $id = $this->filterInt($this->_params[0]);

        }else{

            $this->redirect('/expensescategories');
        }

        $category = ExpenseCategoryModel::getByPK($id);

       // if($category === false || $category->hasRelatedExpensesList() !== false) {
        if($category === false) {
            $this->redirect('/expensescategories');
        }


        $this->language->load('expensescategories.messages');


        if($category->delete()) {
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }

        $this->redirect('/expensescategories');
    }
}
