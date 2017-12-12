<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="/index">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/privileges/create"><?= @$title ?></a></li>
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

                        <label class="control-label"><?= $text_label_privilege_title ?></label>
                        <div class="controls">
                            <input class="form-control" required="required" type="text" name="PrivilegeTitle" id="PrivilegeTitle" maxlength="30" value="<?= $privilege->PrivilegeTitle ?>">
                        </div>


                    </div>
                    <div class="control-group">
                        <label class="control-label"><?= $text_label_privilege_url ?></label>
                        <div class="controls">
                            <input class="form-control" required="required" type="text" name="Privilege" id="Privilege" maxlength="30" value="<?= $privilege->Privilege ?>">
                        </div>


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
