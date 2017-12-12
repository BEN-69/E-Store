<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="/"><?= @$text_page ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/dailyexpenses"><?= @$text_header ?></a></li>
</ul>

<div class="span4">
    <a href="/dailyexpenses/create" class="btn btn-info"><i class="icon-plus"></i> <?= $text_new_item ?></a>
</div>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white user"></i><span class="break"></span><?= @$title ?></h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>

                    <th><?= $text_table_name; ?></th>
                    <th><?= $text_table_price; ?></th>
                    <th><?= $text_table_created; ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if(false !== $expenses): foreach ($expenses as $expense): ?>
                    <tr>

                        <td><?= $expense->ExpenseName === null ? 'pas de categories' : $expense->ExpenseName; ?></td>
                        <td class="center"><?= $expense->ExpenseName ?></td>
                        <td class="center"><?= round($expense->Payment) ?></td>
                        <td class="center"><?= $expense->Created ?></td>
                        <td class="center"><?= $expense->UserId ?></td>
                        <td class="center">
                            <a class="btn btn-info" href="/dailyexpenses/edit/<?= $expense->DExpenseId ?>">
                                <i class="halflings-icon white edit"></i>
                            </a>
                            <a class="btn btn-danger" href="/dailyexpenses/delete/<?= $expense->DExpenseId ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;">
                                <i class="halflings-icon white trash"></i>
                            </a>

                        </td>


                    </tr>
                <?php endforeach; endif; ?>

                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->