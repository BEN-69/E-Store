<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="/"><?= @$text_page ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/suppliers"><?= @$text_header ?></a></li>
</ul>

<div class="span4">
    <a href="/suppliers/create"  class="btn btn-info"><i class="icon-plus"></i> <?= $text_new_item ?></a>
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
                    <th><?= $text_table_name ?></th>
                    <th><?= $text_table_email ?></th>
                    <th><?= $text_table_phone_number ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if(false !== $suppliers): foreach ($suppliers as $supplier): ?>
                    <tr>
                        <td class="center"><?= $supplier->Name ?></td>
                        <td class="center"><?= $supplier->Email ?></td>
                        <td class="center"><?= $supplier->PhoneNumber ?></td>
                        <td>
                            <a class="btn btn-info" href="/suppliers/edit/<?= $supplier->SupplierId ?>"><i class="halflings-icon white edit"></i></a>
                            <a class="btn btn-danger" href="/suppliers/delete/<?= $supplier->SupplierId ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="halflings-icon white trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>

                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->
