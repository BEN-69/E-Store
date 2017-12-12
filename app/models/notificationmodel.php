<?php

namespace MVC\Models;


class NotificationModel extends AbstractModel
{

    public $NotificationId;
    public $Title;
    public $Content;
    public $Type;
    public $Created;
    public $Seen;
    public $UserId;

    public static $tableName = 'app_notifications';

    protected $tableSchema
    = array(
        'Title',
        'Content',
        'Type',
        'Created',
        'Seen',
        'UserId'
    );

    protected static $primaryKey = 'NotificationId';

    public static function notify($userPrivilege, $contractId, $subject, $content, $specific = false)
    {
        if(is_array($userPrivilege)) {
            if($specific !== false) {
                $sql = 'SELECT * FROM app_users WHERE privilege = ' . array_shift($userPrivilege) . ' AND id = ' . array_shift($userPrivilege);
                if(count($userPrivilege) > 1) {
                    $sql .= (count($userPrivilege) > 0) ? (implode(' OR id = ', $userPrivilege)) : '';
                } else {
                    $sql .= array_shift($userPrivilege);
                }

            } else {
                $privilege = implode(' OR privilege = ', $userPrivilege);
                $sql = 'SELECT * FROM app_users WHERE privilege = ' . $privilege;
            }
        } else {
            $sql = 'SELECT * FROM app_users WHERE privilege = ' . $userPrivilege;
        }

        $users = UserModel::query(
            $sql, array(), '\Lilly\Models\EmployeeModel'
        );

        if($users !== false) {
            $notification = null;
            foreach ($users as $user) {
                $notification = new self;
                $notification->content = $content;
                $notification->empId = $user->id;
                $notification->title = $subject;
                $notification->contractId = $contractId;
                $notification->created = date('Y-m-d');
                $notification->seen = 0;
                $notification->save();
            }
        }
        return true;
    }

    public static function notifyOne($user, $contractId, $subject, $content)
    {
        $sql = 'SELECT * FROM app_users WHERE id = ' . $user;

        $user = UserModel::query(
            $sql, array(), '\MVC\Models\UserModel'
        );

        if($user !== false) {
            $user = array_shift($user);
            $notification = null;
            $notification = new self;
            $notification->content = $content;
            $notification->empId = $user->id;
            $notification->title = $subject;
            $notification->contractId = $contractId;
            $notification->created = date('Y-m-d');
            $notification->seen = 0;
            $notification->save();
        }
        return true;
    }
}