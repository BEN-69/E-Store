<?php
/**
 * Created by PhpStorm.
 * User: rabii
 * Date: 29/08/17
 * Time: 10:50
 */

namespace MVC\Controllers;


use MVC\Lib\FileUpload;
use MVC\lib\Messenger;
use MVC\Models\UserGroupModel;
use MVC\Models\UserModel;
use MVC\Models\UserProfileModel;
use MVC\Lib\InputFilter;
use MVC\Lib\Helper;
use MVC\Lib\Validate;


class UsersController extends AbstractController
{

    use InputFilter;
    use Helper;
    use Validate;

    private $_createActionRoles =
        [
            'FirstName'     => 'req|alpha|between(3,10)',
            'LastName'      => 'req|alpha|between(3,10)',
            'Username'      => 'req|alphanum|between(3,12)',
            'Password'      => 'req|min(6)|eq_field(CPassword)',
            'CPassword'     => 'req|min(6)',
            'Email'         => 'req|email|eq_field(CEmail)',
            'CEmail'        => 'req|email',
            'PhoneNumber'   => 'alphanum|max(15)',
            'GroupId'       => 'req|int'
        ];

    private $_editActionRoles =
        [
            'PhoneNumber'   => 'alphanum|max(15)',
            'GroupId'       => 'req|int'
        ];

    private $_editPassActionRoles =
        [

            'Password'      => 'req|min(6)|eq_field(CPassword)',
            'CPassword'     => 'req|min(6)'

        ];

    public function defaultAction()
    {


        $this->language->load('users.default');
        $this->language->load('template.common');
        $this->_data['users'] = UserModel::getUsers($this->session->u);

        $this->_view();
    }


    public function createAction()
    {

        $this->language->load('template.common');
        $this->language->load('users.create');
        $this->language->load('users.labels');
        $this->language->load('users.messages');
        $this->language->load('validation.errors');

        $this->_data['groups'] = UserGroupModel::getAll();


        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {

            $user = new UserModel();
            $user->Username = $this->filterString($_POST['Username']);
            $user->cryptPassword($_POST['Password']);
            $user->Email = $this->filterString($_POST['Email']);
            $user->PhoneNumber = $this->filterString($_POST['PhoneNumber']);
            $user->GroupId = $this->filterInt($_POST['GroupId']);
            $user->SubscriptionDate = date('Y-m-d');
            $user->LastLogin = date('Y-m-d H:i:s');
            $user->Status = 1;

            if(UserModel::userExists($user->Username)) {
                $this->messenger->add($this->language->get('message_user_exists'), Messenger::APP_MESSAGE_ERROR);
                $this->redirect('/users');
            }elseif(UserModel::emailExists($user->Email)) {
                 $this->messenger->add($this->language->get('message_email_exists'), Messenger::APP_MESSAGE_ERROR);
                 $this->redirect('/users');
             }

            // TODO:: SEND THE USER WELCOME EMAIL
            if($user->save()) {
                $userProfile = new UserProfileModel();
                $userProfile->UserId = $user->UserId;
                $userProfile->FirstName = $this->filterString($_POST['FirstName']);
                $userProfile->LastName = $this->filterString($_POST['LastName']);
                $userProfile->save(false);
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/users');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);

            }

        }

        $this->_view();
    }


    public function editAction()
    {

        if(isset($this->_params[0])){

            $id = $this->filterInt($this->_params[0]);

        }else{

            $this->redirect('/users');
        }


        $user = UserModel::getByPK($id);

       if($user === false || $this->session->u->UserId == $id) {

            $this->redirect('/users');
        }

        $this->_data['user'] = $user;

        $this->language->load('template.common');
        $this->language->load('users.edit');
        $this->language->load('users.labels');
        $this->language->load('users.messages');
        $this->language->load('validation.errors');

        $this->_data['groups'] = UserGroupModel::getAll();


        if(isset($_POST['submit']) && $this->isValid($this->_editActionRoles, $_POST)) {

            $user->PhoneNumber = $this->filterString($_POST['PhoneNumber']);
            $user->GroupId = $this->filterInt($_POST['GroupId']);

            if($user->save()) {
                $this->messenger->add($this->language->get('message_create_success'));

            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);

            }
            $this->redirect('/users');
        }

        $this->_view();
    }


    public function deleteAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $user = UserModel::getByPK($id);


        if($user === false || $this->session->u->UserId == $id) {
        //if($user === false){
            $this->redirect('/users');
        }

        $this->language->load('users.messages');

        $userProfile = UserProfileModel::getByPK($id);

        if(false !== $userProfile) {

                $userProfile->delete();

        }

        if($user->delete()) {
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/users');
    }


    public function profileAction()
    {


        $profile = UserProfileModel::getByPK($this->session->u->UserId);

        $this->language->load('template.common');
        $this->language->load('users.labels');
        $this->language->load('users.profile');
        $this->language->load('users.messages');
        $this->language->load('validation.errors');



        $this->_data['profile'] = $profile;
        $uploadError=false;

        if(isset($_POST['submit'])) {

            $profile->FirstName = $this->filterString($_POST['FirstName']);
            $profile->LastName = $this->filterString($_POST['LastName']);
            $profile->Address = $this->filterString($_POST['Address']);
            $profile->DOB = $this->filterString($_POST['DOB']);

            if(!empty($_FILES['Image']['name']) ) {

                // remove old Image
                if(!empty($profile->Image) && file_exists(PROFILES_IMAGES_UPLOAD_STORAGE.DS.$profile->Image) && is_writable(PROFILES_IMAGES_UPLOAD_STORAGE)){

                    unlink(PROFILES_IMAGES_UPLOAD_STORAGE.DS.$profile->Image);
                }

                $upload = new FileUpload($_FILES['Image']);

                try {

                    $upload->upload(PROFILES_IMAGES_UPLOAD_STORAGE);

                    $profile->Image = $upload->getFileName();

                } catch (\Exception $e){

                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);

                    $uploadError=true;
                }
            }


            if($uploadError === false && $profile->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }

            $this->redirect('/users/profile');
        }







        $this->_view();
    }


    public function changepasswordAction()
    {

        $user = UserModel::getByPK($this->session->u->UserId);


        $this->language->load('template.common');
        $this->language->load('users.labels');
        $this->language->load('users.messages');
        $this->language->load('users.changepassword');
        $this->language->load('validation.errors');


        //var_dump($user);

       // exit;


        if(isset($_POST['submit']) && $this->isValid($this->_editPassActionRoles, $_POST)) {


            $user->cryptPassword($_POST['Password']);
            $user->LastLogin = date('Y-m-d H:i:s');

            if($user->save()) {

                $this->messenger->add($this->language->get('message_changepassword_success'));
                $this->redirect('/users/profile');
            } else {
                $this->messenger->add($this->language->get('message_changepassword_failed'), Messenger::APP_MESSAGE_ERROR);

            }
        }

        $this->_view();
    }


    public function settingsAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.labels');
        $this->language->load('users.messages');
        $this->language->load('validation.errors');



        $this->_view();
    }



    // TODO:: make sure this is a AJAX Request
    public function checkUserExistsAjaxAction()
    {
        if(isset($_POST['Username']) && !empty($_POST['Username'])) {
            header('Content-type: text/plain');
            if(UserModel::userExists($this->filterString($_POST['Username'])) !== false) {
                echo 1;
            } else {
                echo 2;
            }
        }
    }


    // TODO:: make sure this is a AJAX Request
    public function checkEmailExistsAjaxAction()
    {
        if(isset($_POST['Email']) && !empty($_POST['Email'])) {
            header('Content-type: text/plain');
            if(UserModel::emailExists($this->filterString($_POST['Email'])) !== false) {
                echo 1;
            } else {
                echo 2;
            }
        }
    }


}