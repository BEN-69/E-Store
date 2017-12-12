<?php

namespace MVC\Controllers;

use MVC\Lib\Messenger;
use MVC\Models\ExpenseCategoryModel;
use MVC\Models\ExpenseModel;
use MVC\Lib\Validate;
use MVC\Lib\InputFilter;
use MVC\Lib\Helper;



class DailyexpensesController extends AbstractController
{
    use Validate;
    use InputFilter;
    use Helper;

    protected $_createActionRoles = [

    ];

    public function defaultAction()
    {
        $this->_data['expenses'] = ExpenseModel::getAll();

        $this->language->load('template.common');
        $this->language->load('dailyexpenses.default');
        $this->language->load('dailyexpenses.labels');

       // $this->injectDataTable();
        $this->_view();
    }
    // TODO:  a corriger cette methode plus tard
    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('dailyexpenses.create');
        $this->language->load('dailyexpenses.labels');

        $this->_data['categories'] = ExpenseCategoryModel::getAll();

        if(isset($_POST['submit'])) {

           /* if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/expenseslist');
                }
           */
                $expense = new ExpenseModel();
                $expense->categoryId = isset($_POST['ExpenseId']) && !empty($_POST['ExpenseId']) ? $this->filterInt($_POST['ExpenseId']) : null;

            if($expense->ExpenseId !== null) $category = ExpenseCategoryModel::getByPK($expense->ExpenseId);
                if(isset($category) && false === $category) {
                    $this->redirect('/expenseslist');
                }
                $expense->Description = $this->filterString($_POST['Description']);
                $expense->Payment = isset($category) ? $category->fixedPayment : $this->filterInt($_POST['payment']);
                $expense->UserId = $this->session->u->id;
                $expense->Created = date('Y-m-d H:i:s');
            var_dump($expense);
             exit;
                if($expense->save()) {

                   /* $outComeVoucher = new OutComeVoucherModel();
                    $outComeVoucher->expenseId = $expense->id;
                    $outComeVoucher->issuedBy = $this->session->u->id;
                    $outComeVoucher->payment = $expense->payment;
                    $outComeVoucher->description = $expense->description;
                    $outComeVoucher->created = $expense->created;

                    $outComeVoucher->save();
                    */

                    $this->messenger->add($this->language->get('message_create_success'));
                }
                 else {
                    $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);

                }
                $this->redirect('/expenseslist');

            //}
        }

        $this->_view();
    }

    public function editAction()
    {
        $id = $this->_getParam(0, 'int');
        $expense = ExpenseModel::getByPK($id);
        if($expense === false) {
            $this->routeTo('/expenseslist');
        }

        $this->_data['expense'] = $expense;

        $this->lang->load('common|template');
        $this->lang->load('expenseslist|edit');
        $this->lang->load('expenseslist|label');

        $this->_data['categories'] = ExpenseCategoryModel::getAll();

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/expenseslist');
                }
                $expense->categoryId = isset($_POST['categoryId']) && !empty($_POST['categoryId']) ? $this->filterInt($_POST['categoryId']) : null;
                if($expense->categoryId !== null) $category = Models\ExpenseCategoryModel::getByPK($expense->categoryId);
                if(isset($category) && false === $category) {
                    $this->routeTo('/expenseslist');
                }
                $expense->description = $this->filterString($_POST['description']);
                $expense->payment = isset($category) ? $category->fixedPayment : $this->filterInt($_POST['payment']);
                $expense->userId = $this->session->u->id;
                $expense->created = date('Y-m-d H:i:s');
                if($expense->save()) {
                    $outComeVoucher = Models\OutComeVoucherModel::getBy('expenseId', $expense->id, Models\OutComeVoucherModel::DATA_TYPE_INT)->current();
                    $outComeVoucher->payment = $expense->payment;
                    $outComeVoucher->description = $expense->description;
                    $outComeVoucher->save();
                    $this->messenger->add(
                        'message',
                        $this->lang->get('expenseslist|common', 'edit_success')
                    );
                    $this->routeTo('/expenseslist');
                }
            }
        }

        $this->_render();
    }

    public function deleteAction()
    {
        if(!$this->requestHasValidToken($_GET['token'])) {
            $this->routeTo('/expenseslist');
        }
        $id = $this->_getParam(0, 'int');
        $expense = ExpenseModel::getByPK($id);
        if($expense === false) {
            $this->routeBack('/expenseslist');
        }
        $voucher = Models\OutComeVoucherModel::getBy('expenseId', $expense->id, Models\OutComeVoucherModel::DATA_TYPE_INT)->current();
        if($voucher->delete() && $expense->delete()){
            $this->messenger->add(
                'message',
                $this->lang->get('expenseslist|common', 'delete_success')
            );
        } else {
            $this->messenger->add(
                'message',
                $this->lang->get('expenseslist|common', 'delete_error'), Messenger::STATUS_ERROR
            );
        }
        $this->routeBack('/expenseslist');
    }
}
