<?php
namespace MVC\Models;

class UserModel extends AbstractModel
{
    public $UserId;
    public $Username;
    public $Password;
    public $Email;
    public $PhoneNumber;
    public $SubscriptionDate;
    public $LastLogin;
    public $GroupId;
    public $Status;

    /**
     * @var UserProfileModel
     */
    public $profile;
    public $privileges;

    protected static $tableName = 'app_users';

    protected static $tableSchema = array(
        'UserId'            => self::DATA_TYPE_INT,
        'Username'          => self::DATA_TYPE_STR,
        'Password'          => self::DATA_TYPE_STR,
        'Email'             => self::DATA_TYPE_STR,
        'PhoneNumber'       => self::DATA_TYPE_STR,
        'SubscriptionDate'  => self::DATA_TYPE_DATE,
        'LastLogin'         => self::DATA_TYPE_STR,
        'GroupId'           => self::DATA_TYPE_INT,
        'Status'            => self::DATA_TYPE_INT,
    );

    protected static $primaryKey = 'UserId';

    public function cryptPassword($password)
    {
        $this->Password = crypt($password, APP_SALT);
    }

    // TODO:: FIX THE TABLE ALIASING
    public static function getAll()
    {

        $sql='SELECT au.*, aug.GroupName GroupName FROM ' . self::$tableName . ' au ';
        $sql.='INNER JOIN '.UserGroupModel::getModelTableName().' aug ';
        $sql.='ON aug.GroupId = au.GroupId';

        return self::get($sql);
    }

    public static function getUsers(UserModel $user)
    {
        $sql='SELECT au.*, aug.GroupName GroupName FROM ' . self::$tableName . ' au ';
        $sql.='INNER JOIN '.UserGroupModel::getModelTableName().' aug ';
        $sql.='ON aug.GroupId = au.GroupId ';
        $sql.='WHERE au.UserId != ' . $user->UserId;

         return self::get($sql);
    }



    public static function userExists($username)
    {
        return self::get('
            SELECT * FROM ' . self::$tableName . ' WHERE Username = "' . $username . '"
        ');
    }


    public static function emailExists($email)
    {
        return self::get('
            SELECT * FROM ' . self::$tableName . ' WHERE Email = "' . $email . '"
        ');
    }

    public static function authenticate ($username, $password, $session)
    {
        $password = crypt($password, APP_SALT) ;
        $sql = 'SELECT *, (SELECT GroupName FROM '.UserGroupModel::getModelTableName().' WHERE app_users_groups.GroupId = ' . self::$tableName . '.GroupId) GroupName FROM ' . self::$tableName . ' WHERE Username = "' . $username . '" AND Password = "' .  $password . '"';
        $foundUser = self::getOne($sql);
        if(false !== $foundUser) {
            if($foundUser->Status == 2) {
                return 2;
            }
            $foundUser->LastLogin = date('Y-m-d H:i:s');
            $foundUser->save();
            $foundUser->profile = UserProfileModel::getByPK($foundUser->UserId);
            $foundUser->privileges = UserGroupPrivilegeModel::getPrivilegesForGroup($foundUser->GroupId);
            $session->u = $foundUser;
            return 1;
        }
        return false;
    }
}