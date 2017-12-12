<?php
namespace MVC\Controllers;

use MVC\Models\MailModel;
use MVC\Lib\Validate;
use MVC\Lib\InputFilter;
use MVC\Lib\Helper;
use MVC\Lib\Messenger;
use MVC\Models\UserModel;
use MVC\Models\UserProfileModel;

class MailsController extends AbstractController
{

    use InputFilter;
    use Helper;
    use Validate;

    private $_forwardActionRoles =
        [
            'Title'         => 'req|alpha|between(3,30)',
            'Content'       => 'req'
        ];


    public function defaultAction()
    {

        $mailSQL = 'SELECT am.*, au.Username as Sender FROM app_mails as am ';
        $mailSQL .= 'LEFT JOIN app_users as au ON am.SenderId = au.UserId ';
        $mailSQL .= 'WHERE am.ReceiverId = ' . $this->session->u->UserId . ' ';
        $mailSQL .= 'ORDER BY am.Created DESC';
        $this->_data['mail'] = MailModel::get($mailSQL);

        $this->language->load('template.common');
        $this->language->load('mails.common');
        $this->language->load('mails.default');

        //$this->injectDataTable();

        $this->_view();
    }

    public function sentAction()
    {
        $mailSQL = 'SELECT am.*, au.Username as Receiver FROM app_mails as am ';
        $mailSQL .= 'LEFT JOIN app_users as au ON am.ReceiverId = au.UserId ';
        $mailSQL .= 'WHERE am.SenderId = ' . $this->session->u->UserId . ' ';
        $mailSQL .= 'ORDER BY am.Created DESC';


        $this->_data['mail'] = MailModel::get($mailSQL);

        $this->language->load('template.common');
        $this->language->load('mails.common');
        $this->language->load('mails.sent');

       // $this->injectDataTable();
        $this->_view();
    }

    public function newAction()
    {

        $this->_data['allowedUsers'] =  UserModel::getUsers($this->session->u);

        $this->language->load('validation.errors');
        $this->language->load('template.common');
        $this->language->load('mails.common');
        $this->language->load('mails.new');
        $this->language->load('mails.messages');

        if(isset($_POST['submit']) && $this->isValid($this->_forwardActionRoles, $_POST)) {

            /*if(!$this->requestHasValidToken($_POST['token'])) {
                $this->redirect('/mail');
            }*/


            if(isset($_POST['ReceiverId']) && !empty($_POST['ReceiverId'])){

                $receiversList = $_POST['ReceiverId'];

                $content = $this->filterString($_POST['Content']);
                $title = $this->filterString($_POST['Title']);
                $mail = null;

                $this->language->load('mails.messages');

                foreach($receiversList as $receiver) {
                    $mail = new MailModel;
                    $mail->SenderId = $this->session->u->UserId;
                    $receiverObj = UserModel::getByPK($this->filterString($receiver));
                    if($receiverObj === false)  {
                        $failedMail = new MailModel();
                        $failedMail->SenderId = $this->session->u->UserId;
                        $failedMail->ReceiverId = $this->session->u->UserId;
                        $failedMail->Created = date('Y-m-d H:i:s');
                        $failedMail->Content = $this->language->get('receiver_not_found_message', array($receiver));
                        $failedMail->Title = $this->language->get('receiver_not_found_title');
                        $failedMail->Seen = 0;
                        $failedMail->save();
                        continue;
                    }

                    $mail->ReceiverId = $receiverObj->UserId;
                    $mail->Created = date('Y-m-d H:i:s');
                    $mail->Content = $content;
                    $mail->Title = $title;
                    $mail->Seen = 0;
                    $mail->save();

                    $this->messenger->add($this->language->get('mail_sent_success'));
                    $this->redirect('/mails');
                }

            }else{

                $this->messenger->add($this->language->get('receiver_not_found'), Messenger::APP_MESSAGE_ERROR);

            }

        }



        $this->_view();
    }

    public function viewAction()
    {

        if(isset($this->_params[0])){

            $id = $this->filterInt($this->_params[0]);

        }else{

            $this->redirect('/mails');
        }

        $mail = MailModel::getByPK($id);


        if($mail === false || $mail->ReceiverId != $this->session->u->UserId) {
            $this->redirect('/mails');
        }


        if($mail->Seen == 0) {
            $mail->Seen = 1;
            $mail->save();
            $this->redirect('/mails/view/'.$mail->Id);
        }

        $this->_data['mail'] = $mail;
        $this->_data['sender'] = UserModel::getByPK($mail->SenderId);
        $this->_data['profile'] = UserProfileModel::getByPK($mail->SenderId);
        $this->language->load('template.common');
        $this->language->load('mails.common');
        $this->language->load('mails.view');

        $this->_view();
    }

    public function forwardAction()
    {

        if(isset($this->_params[0])){

            $id = $this->filterInt($this->_params[0]);

        }else{

            $this->redirect('/mails');
        }

        $mail = MailModel::getByPK($id);

        if($mail === false || $mail->ReceiverId != $this->session->u->UserId) {
            $this->redirect('/mails');
        }

        $this->_data['mail'] = $mail;
;

        $this->_data['allowedUsers'] = UserModel::getUsers($this->session->u);

        $this->language->load('validation.errors');
        $this->language->load('template.common');
        $this->language->load('mails.common');
        $this->language->load('mails.forward');
        $this->language->load('mails.messages');


        if(isset($_POST['submit']) && $this->isValid($this->_forwardActionRoles, $_POST)) {

            /*  if(!$this->requestHasValidToken($_POST['token'])) {
                  $this->redirect('/mail');
              }*/

            if (isset($_POST['ReceiverId']) && !empty($_POST['ReceiverId'])) {
                $receiversList = $_POST['ReceiverId'];

                if (empty($receiversList)) {
                    $this->redirect('/mails');
                }

                $content = $this->filterString($_POST['Content']);
                $title = $this->filterString($_POST['Title']);
                $mail = null;

                foreach($receiversList as $receiver) {
                    $mail = new MailModel;
                    $mail->SenderId = $this->session->u->UserId;
                    $receiverObj = UserModel::getByPK($this->filterString($receiver));
                    if($receiverObj === false)  {
                        $failedMail = new MailModel();
                        $failedMail->SenderId = $this->session->u->UserId;
                        $failedMail->ReceiverId = $this->session->u->UserId;
                        $failedMail->Created = date('Y-m-d H:i:s');
                        $failedMail->Content = $this->language->get('receiver_not_found_message', array($receiver));
                        $failedMail->Title = $this->language->get('receiver_not_found_title');
                        $failedMail->Seen = 0;
                        $failedMail->save();
                        continue;
                    }
                    $mail->ReceiverId = $receiverObj->UserId;
                    $mail->Created = date('Y-m-d H:i:s');
                    $mail->Content = $content;
                    $mail->Title = $title;
                    $mail->Seen = 0;

                    $mail->save();

                    $this->messenger->add($this->language->get('mail_sent_success'));
                    $this->redirect('/mails');
                }


                $this->redirect('/mails');
            }else{

                $this->messenger->add($this->language->get('receiver_not_found'), Messenger::APP_MESSAGE_ERROR);
            }
        }
        $this->_view();
    }

    public function replyAction()
    {
        if(isset($this->_params[0])){

            $id = $this->filterInt($this->_params[0]);

        }else{

            $this->redirect('/mails');
        }
        $mail = MailModel::getByPK($id);

        if($mail === false || $mail->ReceiverId != $this->session->u->UserId) {
            $this->redirect('/mails');
        }

        $this->_data['mail'] = $mail;

        $this->language->load('template.common');
        $this->language->load('mails.common');
        $this->language->load('mails.reply');
        $this->language->load('mails.messages');

        if(isset($_POST['submit'])) {

          /*  if(!$this->requestHasValidToken($_POST['token'])) {
                $this->redirect('/mail');
            }*/

            $newmail = new MailModel();
            $newmail->SenderId = $this->session->u->UserId;
            $newmail->ReceiverId = $mail->SenderId;
            $newmail->Created = date('Y-m-d H:i:s');
            $newmail->Content = $this->filterString($_POST['Content']);
            $newmail->Title = $this->filterString($_POST['Title']);
            $newmail->Seen = 0;

            if($newmail->save()){

                $this->messenger->add($this->language->get('mail_sent_success'));

                $this->redirect('/mails');

            }else{
                $this->messenger->add($this->language->get('mail_sent_failed'), Messenger::APP_MESSAGE_ERROR);

            }

        }


        $this->_view();
    }

    public function deleteAction()
    {
       /* if(!$this->requestHasValidToken($_GET['token'])) {
            $this->redirect('/mail');
        }*/


        if(isset($this->_params[0])){

            $id = $this->filterInt($this->_params[0]);

        }else{

            $this->redirect('/mails');
        }

        $mail = MailModel::getByPK($id);

        if($mail === false || $mail->ReceiverId != $this->session->u->UserId) {
            $this->redirect('/mails');
        }
        $this->language->load('mails.messages');
        if($mail->delete()) {

            $this->messenger->add($this->language->get('mail_delete_success'));

        } else {
            $this->messenger->add($this->language->get('mail.messages', 'mail_delete_failed'), Messenger::STATUS_ERROR);
        }
        $this->redirect('/mails');
    }
}