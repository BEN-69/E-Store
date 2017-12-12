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
    <li><a href="/users/edit/<?= $user->UserId ?>"><?= @$title ?></a></li>
</ul>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?= $title ?></h2>
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
                        <label class="control-label"><?= $text_label_PhoneNumber ?></label>
                        <div class="controls">
                            <input required="required" type="text" class="form-control" name="PhoneNumber" value="<?= $this->showValue('PhoneNumber', $user) ?>">
                        </div>

                    </div>
                    <div class="control-group">

                        <label class="control-label" for="typeahead"><?= $text_user_GroupId ?></label>

                        <div class="controls">
                            <select required name="GroupId">
                                <?php if (false !== $groups): foreach ($groups as $group): ?>
                                    <option value="<?= $group->GroupId ?>" <?= $this->selectedIf('GroupId', $group->GroupId, $user) ?>><?= $group->GroupName ?></option>
                                <?php endforeach;endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="btn btn-primary"><?= $text_label_save ?></button>
                    </div>

                </fieldset>
            </form>

        </div>

    </div><!--/span-->

</div><!--/row-->



