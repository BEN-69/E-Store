<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="/"><?= $text_page ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <a href="/users"><?= $title_base ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/users/create"><?= @$title ?></a></li>
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

                        <label class="control-label" for="typeahead"><?= $text_label_FirstName ?></label>

                        <div class="controls">
                            <input type="text" class="form-control" id="FirstName" name="FirstName" required="required"
                                   value="<?= $this->showValue('FirstName') ?>" maxlength="10"/>
                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label" for="typeahead"><?= $text_label_LastName ?></label>

                        <div class="controls">
                            <input type="text" class="form-control" id="LastName" name="LastName" required="required"
                                   value="<?= $this->showValue('LastName') ?>" maxlength="10"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="typeahead"><?= $text_label_Username ?></label>

                        <div class="controls">
                            <input type="text" class="form-control" id="Username" name="Username" required="required"
                                   value="<?= $this->showValue('Username') ?>" maxlength="30"/>
                        </div>
                    </div>

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


                    <div class="control-group">
                        <label class="control-label" for="typeahead"><?= $text_label_Email ?></label>

                        <div class="controls">
                            <input type="email" class="form-control" id="Email" name="Email" required="required"
                                   value="<?= $this->showValue('Email') ?>" maxlength="40"/>
                        </div>

                    </div>

                    <div class="control-group">
                        <label class="control-label" for="typeahead"><?= $text_label_CEmail ?></label>

                        <div class="controls">
                            <input type="email" class="form-control" id="CEmail" name="CEmail" required="required"
                                   value="<?= $this->showValue('CEmail') ?>" maxlength="40"/>
                        </div>

                    </div>


                    <div class="control-group">
                        <label class="control-label" for="typeahead"><?= $text_label_PhoneNumber ?></label>

                        <div class="controls">
                            <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" required="required"
                                   value="<?= $this->showValue('PhoneNumber') ?>" maxlength="40"/>
                        </div>

                    </div>


                    <div class="control-group select">
                        <label class="control-label" for="typeahead"><?= $text_user_GroupId ?></label>
                        <div class="controls">
                            <select required name="GroupId">
                                <?php if (false !== $groups): foreach ($groups as $group): ?>
                                    <option value="<?= $group->GroupId ?>"><?= $group->GroupName ?></option>
                                <?php endforeach;endif; ?>
                            </select>
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






