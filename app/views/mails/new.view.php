<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="/"><?= $text_page ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <a href="/mails"><?= $title_base ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/mails/new"><?= @$title ?></a></li>
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

                        <label class="control-label" for="typeahead"><?= $text_label_Title ?></label>

                        <div class="controls">
                            <input type="text" class="form-control" id="Title" name="Title" required="required"
                                   value="<?= $this->showValue('Title') ?>" maxlength="30"/>
                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label"><?= $text_label_Receiver ?></label>
                        <?php if (false !== $allowedUsers): foreach ($allowedUsers as $auser): ?>
                            <div class="controls">
                                <label class="span4">

                                    <input type="checkbox" name="ReceiverId[]" id="ReceiverId" value="<?= $auser->UserId  ?>">
                                    <span><?= $auser->Username ?></span>
                                </label>
                            </div>

                        <?php endforeach; endif; ?>


                    </div>


                    <div class="control-group">
                        <label class="control-label" for="textarea2"><?= $text_label_Content ?></label>

                        <div class="controls">
                            <textarea class="cleditor" required name="Content" id="Content" cols="30" maxlength="255" rows="10">
                                <?= $this->showValue('Content') ?>
                            </textarea>
                        </div>
                    </div>


                    <div class="form-actions">
                        <!--input type="hidden" name="token" value="<?= $this->_registry->session->CSRFToken ?>"-->
                        <button type="submit" name="submit" class="btn btn-primary"><?= $text_label_save ?></button>
                        <button type="reset" class="btn">Cancel</button>
                    </div>

                </fieldset>
            </form>

        </div>

    </div>
    <!--/span-->

</div><!--/row-->


