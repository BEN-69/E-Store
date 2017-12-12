<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="/">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/notifications"> <?= $title ?></a></li>
</ul>

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

                    <th style="width: 300px"><?= $text_table_title; ?></th>
                    <th><?= $text_table_datetime; ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if($notifications !== false) {
                    foreach($notifications as $notification) {
                        ?>
                        <tr>
                            <td<?= ($notification->Seen == 0) ? ' class="unread"' : ' class="read"' ?>><a title="<?= $text_table_control_view ?>" href="/notifications/view/<?= $notification->NotificationId ?>"><?= $notification->Title; ?></a></td>
                            <td class="center"><?= $notification->Created; ?></td>
                            <a class="btn btn-danger"  href="/mails/delete/<?= $mailObj->Id ?>/?token=<?//= $this->session->CSRFToken ?>" title="<?= $text_table_control_delete ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"> <i class="halflings-icon white trash"></i></a>

                        </tr>
                        <?php
                    }
                }
                ?>

                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->