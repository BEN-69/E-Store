<?php
namespace MVC\Controllers;

use MVC\Models\MailModel;
use MVC\Models\NotificationModel;
use MVC\Lib\Validate;
use MVC\Lib\InputFilter;
use MVC\Lib\Helper;

class NotificationsController extends AbstractController
{
    use Validate;
    use InputFilter;
    use Helper;

    public function defaultAction()
    {


        $sql = 'SELECT * FROM app_notifications ';
        $sql .= 'WHERE UserId = ' . $this->session->u->UserId . ' ';
        $sql .= 'ORDER BY UserId DESC';
        $this->_data['notifications'] = MailModel::get($sql);

        var_dump($this->_data['notifications']);

        $this->language->load('template.common');
        $this->language->load('notifications.common');
        $this->language->load('notifications.default');

       // $this->injectDataTable();

        $this->_view();
    }

    public function viewAction()
    {

        if(isset($this->_params[0])){

            $id = $this->filterInt($this->_params[0]);

        }else{

            $this->redirect('/notifications');
        }
        $notification = NotificationModel::getByPK($id);


        if($notification === false || $notification->UserId != $this->session->u->UserId) {
            $this->redirect('/notifications');
        }

        if($notification->Seen == 0) {
            $notification->Seen = 1;
            $notification->save();
            $this->redirect('/notifications/view/'.$notification->NotificationId);
        }

        $this->_data['notification'] = $notification;

        $this->language->load('template.common');
        $this->language->load('notification.common');
        $this->language->load('notification.view');

        $this->_view();
    }
}