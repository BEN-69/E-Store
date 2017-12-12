<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="/"><?= $text_page ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <a href="/users/profile/"><?= $title_base ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/users/changepassword/<?= $this->session->u->UserId ?>"><?= @$title ?></a></li>
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
            <form autocomplete="off" class="form-horizontal" method="post" enctype="application/x-www-form-urlencoded">
                <fieldset>

                    <div class="control-group">
                        <label class="control-label" for="typeahead"><?= $text_label_Password ?></label>

                        <div class="controls">
                            <input type="password" class="form-control" id="Password" name="Password" required="required"
                                   value="<?= $this->showValue('Password') ?>" maxlength="9"/>
                        </div>
                    </div>



                    <div class="control-group">
                        <label class="control-label" for="typeahead"><?= $text_label_CPassword ?></label>

                        <div class="controls">
                            <input type="password" class="form-control" id="CPassword" name="CPassword" required="required"
                                   value="<?= $this->showValue('Password') ?>" maxlength="9"/>
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