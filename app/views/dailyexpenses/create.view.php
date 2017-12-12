<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="/"><?= $text_page ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <a href="/dailyexpenses"><?= $title_base ?></a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/dailyexpenses/create"><?= @$title ?></a></li>
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
            <form autocomplete="off" class="form-horizontal" method="post" enctype="multipart/form-data">
                <fieldset>


                    <div class="control-group select">
                        <label class="control-label" for="typeahead"><?= $text_label_category ?></label>
                        <div class="controls">
                            <select required name="ExpenseId">
                                <option value=""><?= $text_select_category ?></option>
                                <?php if (false !== $categories): foreach ($categories as $category): ?>
                                    <option value="<?= $category->ExpenseId ?>"><?= $category->ExpenseName ?></option>
                                <?php endforeach;endif; ?>
                            </select>
                        </div>
                    </div>


                    <div class="control-group">

                        <label class="control-label"><?= $text_label_payment ?></label>
                        <div class="controls">
                            <input class="form-control" required="required" type="number" step="0.01" min="1"
                                   name="Payment" id="Payment" value="<?= $this->showValue('Payment') ?>">
                        </div>

                    </div>


                    <div class="control-group">

                        <label class="control-label"><?= $text_label_description ?></label>
                        <div class="controls">
                            <textarea class="form-control" required="required" type="text"
                                   name="Description" id="Description" value="<?= $this->showValue('Description') ?>">

                                </textarea>
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