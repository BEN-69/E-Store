<?php
namespace MVC\Models;

class ExpenseCategoryModel extends AbstractModel
{

    public $ExpenseId;
    public $ExpenseName;
    public $FixedPayment;

    protected static $tableName = 'app_expenses_categories';

    protected static $primaryKey = 'ExpenseId';

    protected static $tableSchema = array(
        'ExpenseName'              => self::DATA_TYPE_STR,
        'FixedPayment'      => self::DATA_TYPE_DECIMAL,
    );

    public function hasRelatedExpensesList ()
    {
        return self::get('SELECT * FROM app_expenses_transactions WHERE categoryId = ' . $this->id);
    }
}
