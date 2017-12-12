<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="/"><?= $text_page ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/users"><?= @$title ?></a></li>
</ul>

<div class="span4">
    <a class="btn btn-info" href="users/create"><i class="icon-plus"></i> <?= @$text_new_item ?></a>
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
                    <th><?= $text_table_username ?></th>
                    <th><?= $text_table_group ?></th>
                    <th><?= $text_table_email ?></th>
                    <th><?= $text_table_subscription_date ?></th>
                    <th><?= $text_table_last_login ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
                </thead>
                <tbody>

                <?php   if(false !== $users) {
                   foreach ($users as $user) { ?>
                <tr>


                    <td class="center"><?= $user->Username ?></td>
                    <td class="center"><?= $user->GroupName ?></td>
                    <td class="center"><?= $user->Email ?></td>
                    <td class="center"><?= $user->SubscriptionDate ?></td>
                    <td class="center"><?= $user->LastLogin ?></td>

                    <td class="center">

                        <a class="btn btn-info" href="users/edit/<?= $user->UserId ?>">
                            <i class="halflings-icon white edit"></i>
                        </a>
                        <a class="btn btn-danger" href="users/delete/<?= $user->UserId ?>">
                            <i class="halflings-icon white trash"></i>

                        </a>

                </tr>
                <?php }

                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->







