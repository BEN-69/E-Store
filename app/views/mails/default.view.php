<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="/">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/mails"><?= @$text_header ?></a></li>
</ul>

<div class="span4">
    <a href="/mails/new" class="btn btn-info"><i class="icon-plus"></i> <?= $text_new_item ?></a>
    <a class="btn btn-info" href="/mails/sent"><i class="icon-paper-plane"></i> <?= $text_label_sent ?></a>

</div>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white envelope"></i><span class="break"></span><?= $text_label_inbox ?> (<?= ($mail !== false) ? count($mail) : 0 ?>)</h2>
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

                    <th style="width: 400px"><?= $text_table_title; ?></th>

                    <th><?= $text_table_sender; ?></th>
                    <th><?= $text_table_datetime; ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
                </thead>
                <tbody>

                <?php if($mail !== false): foreach ($mail as $mailObj): ?>
                    <tr>
                        <td class="center"><a title="<?= $text_table_control_view ?>" href="/mails/view/<?= $mailObj->Id ?>"><?= $mailObj->Title; ?></a></td>
                        <td class="center"><?= $mailObj->Sender; ?></td>
                        <td class="center"><?= $mailObj->Created; ?></td>
                        <td class="center">
                            <a class="btn btn-info" href="/mails/reply/<?= $mailObj->Id ?>" title="<?= $text_table_control_reply ?>"><i class="icon-reply white edit"></i></i></a>
                            <a class="btn btn-info" href="/mails/forward/<?= $mailObj->Id ?>" title="<?= $text_table_control_forward ?>"><i class="icon-arrow-up"></i></a>
                            <a class="btn btn-danger"  href="/mails/delete/<?= $mailObj->Id ?>/?token=<?//= $this->session->CSRFToken ?>" title="<?= $text_table_control_delete ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"> <i class="halflings-icon white trash"></i></a>
                        </td>

                    </tr>
                <?php endforeach; endif; ?>

                </tbody>
            </table>

        </div>
    </div><!--/span-->

</div><!--/row-->