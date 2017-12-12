<?php
namespace MVC\Models;

class UserMailModel extends AbstractModel
{
    public $UserId;
    public $FirstName;
    public $Email;
    public $Expediteur;
    public $Destinateur;
    public $SentDate;

    protected static $tableName = 'app_users_mails';

    protected static $tableSchema = array(
        'UserId'            => self::DATA_TYPE_INT,
        'FirstName'         => self::DATA_TYPE_STR,
        'Email   '          => self::DATA_TYPE_STR,
        'Expediteur'        => self::DATA_TYPE_STR,
        'Destinateur'       => self::DATA_TYPE_STR,
        'SentDate'          => self::DATA_TYPE_DATE,
    );

    protected static $primaryKey = 'UserId';



    // TODO:: FIX THE TABLE ALIASING
    public static function getMai($id)
    {
         return self::get(
            'SELECT * FROM ' . self::$tableName . ' WHERE UserId != ' . $id
        );
    }
}