<?php
namespace MVC\Controllers;

use MVC\Lib\Helper;
use MVC\Lib\InputFilter;
use MVC\Lib\Messenger;
use MVC\Models\SupplierModel;
use MVC\Lib\Validate;

class SuppliersController extends AbstractController
{

    use InputFilter;
    use Helper;
    use Validate;

    private $_createActionRoles =
    [
        'Name'          => 'req|alpha|between(3,40)',
        'Email'         => 'req|email',
        'PhoneNumber'   => 'alphanum|max(15)',
        'Address'       => 'req|alphanum|max(50)'
    ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('suppliers.default');

        $this->_data['suppliers'] = SupplierModel::getAll();

        $this->_view();
    }

    public function createAction()
    {

        $this->language->load('template.common');
        $this->language->load('suppliers.create');
        $this->language->load('suppliers.labels');
        $this->language->load('suppliers.messages');
        $this->language->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {

            $supplier = new SupplierModel();

            $supplier->Name = $this->filterString($_POST['Name']);
            $supplier->Email = $this->filterString($_POST['Email']);
            $supplier->PhoneNumber = $this->filterString($_POST['PhoneNumber']);
            $supplier->Address = $this->filterString($_POST['Address']);

            if($supplier->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/suppliers');
        }

        $this->_view();
    }

    public function editAction()
    {

        if(isset($this->_params[0])){

            $id = $this->filterInt($this->_params[0]);

        }else{

            $this->redirect('/suppliers');
        }

        $supplier = SupplierModel::getByPK($id);

        if($supplier === false) {
            $this->redirect('/suppliers');
        }

        $this->_data['supplier'] = $supplier;

        $this->language->load('template.common');
        $this->language->load('suppliers.edit');
        $this->language->load('suppliers.labels');
        $this->language->load('suppliers.messages');
        $this->language->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {

            $supplier->Name = $this->filterString($_POST['Name']);
            $supplier->Email = $this->filterString($_POST['Email']);
            $supplier->PhoneNumber = $this->filterString($_POST['PhoneNumber']);
            $supplier->Address = $this->filterString($_POST['Address']);

            if($supplier->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/suppliers');
        }

        $this->_view();
    }

    public function deleteAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $supplier = SupplierModel::getByPK($id);

        if($supplier === false) {
            $this->redirect('/suppliers');
        }

        $this->language->load('suppliers.messages');

        if($supplier->delete()) {
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/suppliers');
    }
}