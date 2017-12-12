<?php
namespace MVC\Controllers;
use MVC\Lib\Helper;
use MVC\Lib\InputFilter;
use MVC\Lib\Messenger;
use MVC\Models\PrivilegeModel;
use MVC\Models\UserGroupPrivilegeModel;

class PrivilegesController extends AbstractController
{
    use InputFilter;
    use Helper;

    private $_createActionRoles =
    [

    ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('privileges.default');
        $this->language->load('privileges.messages');

        $this->_data['privileges'] = PrivilegeModel::getAll();


        $this->_view();
    }

    // TODO: we need to implement csrf prevention
    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('privileges.labels');
        $this->language->load('privileges.create');
        $this->language->load('privileges.messages');

        if(isset($_POST['submit'])) {
            $privilege = new PrivilegeModel();
            $privilege->PrivilegeTitle = $this->filterString($_POST['PrivilegeTitle']);
            $privilege->Privilege = $this->filterString($_POST['Privilege']);

            if($privilege->save())
            {
                $this->messenger->add($this->language->get('message_create_success'));

            }else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }

            $this->redirect('/privileges');
        }

        $this->_view();
    }

    public function editAction()
    {


        if(isset($this->_params[0])){

            $id = $this->filterInt($this->_params[0]);

        }else{

            $this->redirect('/privileges');
        }


        $privilege = PrivilegeModel::getByPK($id);

        if($privilege === false) {
            $this->redirect('/privileges');
        }

        $this->_data['privilege'] = $privilege;

        $this->language->load('template.common');
        $this->language->load('privileges.labels');
        $this->language->load('privileges.edit');
        $this->language->load('privileges.messages');


        if(isset($_POST['submit'])) {
            $privilege->PrivilegeTitle = $this->filterString($_POST['PrivilegeTitle']);
            $privilege->Privilege = $this->filterString($_POST['Privilege']);
            if($privilege->save())
            {

                $this->messenger->add($this->language->get('message_create_success'));

            }else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/privileges');

        }

        $this->_view();
    }

    public function deleteAction()
    {

        $this->language->load('privileges.messages');

        $id = $this->filterInt($this->_params[0]);
        $privilege = PrivilegeModel::getByPK($id);

        if($privilege === false) {
            $this->redirect('/privileges');
        }

        $groupPrivileges = UserGroupPrivilegeModel::getBy(['PrivilegeId' => $privilege->PrivilegeId]);
        if(false !== $groupPrivileges) {
            foreach ($groupPrivileges as $groupPrivilege) {
                $groupPrivilege->delete();
            }
        }

        if($privilege->delete())
        {
            $this->messenger->add($this->language->get('message_delete_success'));

        }else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/privileges');
    }

}