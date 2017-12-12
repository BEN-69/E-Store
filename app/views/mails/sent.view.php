<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="/"><?= $text_page ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/mails/sent"><?= @$text_header ?></a></li>
</ul>

<div class="span4">
    <a href="/mails/new" class="btn btn-info"><i class="icon-plus"></i> <?= $text_new_item ?></a>
    <a class="btn btn-info" href="/mails"><i class="icon-envelope"></i> <?= $text_label_inbox ?></a>

</div>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white user"></i><span class="break"></span><?= $text_label_sent ?> (<?= ($mail !== false) ? count($mail) : 0 ?>)</h2>
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

                    <th style="width: 300px"><?= $text_table_title; ?></th>
                    <th><?= $text_table_sender; ?></th>
                    <th><?= $text_table_datetime; ?></th>
                </tr>
                </thead>

                <tbody>
                <?php if($mail !== false): foreach ($mail as $mailObj): ?>
                    <tr>
                        <td class="center"><?= $mailObj->Title; ?></td>

                        <td class="center"><?= $mailObj->Receiver; ?></td>
                        <td class="center"><?= $mailObj->Created; ?></td>

                    </tr>
                <?php endforeach; endif; ?>

                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->