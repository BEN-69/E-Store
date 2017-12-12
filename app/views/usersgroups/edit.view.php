<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="/"><?= $text_page ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <a href="/usersgroups"><?= $title_base ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/usersgroups/edit/<?= $group->GroupId ?>"><?= @$title ?></a></li>
</ul>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?= $text_legend ?></h2>

            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>

        <div class="box-content">
            <form autocomplete="off" class="form-horizontal" method="post" enctype="application/x-www-form-urlencoded">
                <fieldset>

                    <div class="control-group">

                        <label class="control-label"><?= $text_label_group_title ?></label>

                        <div class="controls">
                            <input class="form-control" required="required" type="text" name="GroupName" id="GroupName"
                                   value="<?= $group->GroupName ?>" maxlength="20">
                        </div>


                    </div>

                    <div class="control-group">

                        <label class="control-label"><?= $text_label_privileges ?></label>
                        <?php if ($privileges !== false): foreach ($privileges as $privilege): ?>
                            <div class="controls">
                                <label class="span4">
                                    <input type="checkbox" name="privileges[]"
                                           id="privileges" <?= in_array($privilege->PrivilegeId, $groupPrivileges) ? 'checked' : '' ?>
                                           value="<?= $privilege->PrivilegeId ?>">
                                    <span><?= $privilege->PrivilegeTitle ?></span>
                                </label>
                            </div>

                        <?php endforeach; endif; ?>


                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="btn btn-primary"><?= $text_label_save ?></button>
                    </div>

                </fieldset>
            </form>

        </div>

    </div>
    <!--/span-->

</div><!--/row-->

