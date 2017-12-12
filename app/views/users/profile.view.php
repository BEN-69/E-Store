<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="/index">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/users/profile"><?= @$title ?></a></li>
</ul>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?= $text_header ?></h2>

            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>

        <div class="box-content">
            <form autocomplete="off" class="form-horizontal" method="post" enctype="multipart/form-data">
                <fieldset>

                    <div class="control-group">

                        <label class="control-label"><?= $text_label_FirstName ?></label>
                        <div class="controls">
                            <input class="form-control" required="required" type="text" name="FirstName" id="FirstName"
                                   value="<?= $this->showValue('FirstName', $profile) ?>" maxlength="10">
                        </div>

                    </div>
                    <div class="control-group">
                        <label class="control-label"><?= $text_label_LastName ?></label>
                        <div class="controls">
                            <input class="form-control" required="required" type="text" name="LastName" id="LastName"
                                   value="<?= $this->showValue('LastName', $profile) ?>" maxlength="10">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><?= $text_label_Address ?></label>
                        <div class="controls">
                            <input class="form-control" required="required" type="text" name="Address" id="Address"
                                   value="<?= $this->showValue('Address', $profile) ?>" maxlength="50">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"><?= $text_label_DOB ?></label>
                        <div class="controls">
                            <input class="form-control" required="required" type="date" name="DOB" id="DOB"
                                   value="<?= $this->showValue('DOB', $profile) ?>" maxlength="30">
                        </div>
                    </div>

                    <?php if($profile->Image !='') : ?>
                        <div class="control-group">
                            <div class="controls">
                                <img src="/uploads/images/profiles/<?= $profile->Image ?>" alt="image product" width="30%">
                            </div>
                        </div>
                    <?php endif; ?>


                    <div class="control-group">

                        <label class="control-label"><?= $text_label_Image ?></label>
                        <div class="controls">
                            <input class="form-control" type="file" name="Image" id="Image"
                                   maxlength="40" accept="image/*" value="<?= $this->showValue('Image') ?>">
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="btn btn-primary"><?= $text_label_save ?></button>
                        <button type="reset" class="btn">Cancel</button>
                    </div>

                </fieldset>
            </form>

        </div>

    </div>
    <!--/span-->

</div><!--/row-->