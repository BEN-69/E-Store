<?php
namespace MVC\Models;


class MailModel extends AbstractModel
{

    public $Id;
    public $SenderId;
    public $ReceiverId;
    public $Created;
    public $Title;
    public $Content;
    public $Seen;

    protected static $tableName = 'app_mails';

    protected static $tableSchema = array(
        'SenderId'      => self::DATA_TYPE_INT,
        'ReceiverId'    => self::DATA_TYPE_INT,
        'Created'       => self::DATA_TYPE_DATE,
        'Title'         => self::DATA_TYPE_STR,
        'Content'       => self::DATA_TYPE_STR,
        'Seen'          => self::DATA_TYPE_INT
    );
    protected static $primaryKey = 'Id';
}