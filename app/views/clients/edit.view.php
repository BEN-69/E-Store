<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="/"><?= $text_page ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <a href="/clients"><?= $title_base ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/clients/edit/<?= $client->ClientId ?>"><?= @$title ?></a></li>
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
                    <fieldset>

                        <div class="control-group">

                            <label class="control-label"><?= $text_label_Name ?></label>
                            <div class="controls">
                                <input class="form-control" required="required" type="text" name="Name" id="Name"
                                       maxlength="40" value="<?= $this->showValue('Name',$client) ?>">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label"><?= $text_label_Email ?></label>
                            <div class="controls">
                                <input class="form-control" required="required" type="text" name="Email" id="Email"
                                       maxlength="40" value="<?= $this->showValue('Email',$client) ?>">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label"><?= $text_label_PhoneNumber ?></label>
                            <div class="controls">
                                <input class="form-control" required="required" type="text" name="PhoneNumber" id="PhoneNumber"
                                       maxlength="40" value="<?= $this->showValue('PhoneNumber',$client) ?>">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label"><?= $text_label_Address ?></label>
                            <div class="controls">
                                <input class="form-control" required="required" type="text" name="Address" id="Address"
                                       maxlength="40" value="<?= $this->showValue('Address',$client) ?>">
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