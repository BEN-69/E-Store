<?php
namespace MVC\Controllers;
use MVC\Lib\Helper;
use MVC\Lib\InputFilter;
use MVC\Models\PrivilegeModel;
use MVC\Models\UserGroupModel;
use MVC\Models\UserGroupPrivilegeModel;
use MVC\Models\UserProfileModel;

class ProfilesController extends AbstractController
{

    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('profiles.default');



        $this->_data['profiles'] = UserProfileModel::getProfiles($this->session->u->UserId);

        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('profiles.create');
        $this->language->load('profiles.labels');

        $this->_data['profiles'] = UserProfileModel::getAll();

        if(isset($_POST['submit'])) {
            $group = new UserGroupModel();
            $group->GroupName = $this->filterString($_POST['GroupName']);
            if($group->save())
            {
                if(isset($_POST['privileges']) && is_array($_POST['privileges'])) {
                    foreach ($_POST['privileges'] as $privilegeId) {
                        $groupPrivilege = new UserGroupPrivilegeModel();
                        $groupPrivilege->GroupId = $group->GroupId;
                        $groupPrivilege->PrivilegeId = $privilegeId;
                        $groupPrivilege->save();
                    }
                }
                $this->redirect('/usersgroups');
            }
        }

        $this->_view();
    }

    public function editAction()
    {

        if(isset($this->_params[0])){

            $id = $this->filterInt($this->_params[0]);

        }else{

            $this->redirect('/profiles');
        }

        $profile = UserProfileModel::getByPK($id);

        if($profile === false) {
            $this->redirect('/profiles');
        }

        $this->language->load('template.common');
        $this->language->load('profiles.edit');
        $this->language->load('profiles.labels');

        if(isset($_POST['submit'])) {
            $profile->FirstName = $this->filterString($_POST['PrivilegeTitle']);
            $profile->LastName = $this->filterString($_POST['Privilege']);
            $profile->Address = $this->filterString($_POST['Privilege']);
            $profile->DOB = $this->filterString($_POST['DOB']);
            $profile->Image = $this->filterString($_POST['Image']);

            if($profile->save())
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

        if(isset($this->_params[0])){

            $id = $this->filterInt($this->_params[0]);

        }else{

            $this->redirect('/profiles');
        }

        $profile = UserProfileModel::getByPK($id);

        if($profile === false) {
            $this->redirect('/profiles');
        }

        if($profile->delete()) {
            $this->redirect('/profiles');
        }
    }
}