<?php
namespace MVC\Models;


class ExpenseModel extends AbstractModel
{

    public $DExpenseId;
    public $ExpenseId;
    public $Payment;
    public $Created;
    public $UserId;

    protected static $tableName = 'app_expenses_daily_list';

    protected static $primaryKey = 'DExpenseId';

    protected static $tableSchema = array(

        'ExpenseId'         => self::DATA_TYPE_INT,
        'Description'       => self::DATA_TYPE_STR,
        'Payment'           => self::DATA_TYPE_DECIMAL,
        'Created'           => self::DATA_TYPE_DATE,
        'UserId'            => self::DATA_TYPE_INT
    );

    public static function getAll()
    {

        $sql='SELECT aedl.*, aec.ExpenseName ExpensesName FROM ' . self::$tableName . ' aedl ';
        $sql.='LEFT JOIN '.ExpenseCategoryModel::getModelTableName().' aec ';
        $sql.='ON aedl.ExpenseId = aec.ExpenseId';

        return self::get($sql);
    }


}
