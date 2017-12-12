<!-- start: Content -->
<div id="content" class="span10">

<?php $messages = $this->messenger->getMessages(); if(!empty($messages)){ ?>
    <div class="row-fluid">
        <div class="box span12">

            <div class="box-header">
                <h2><i class="halflings-icon white white bullhorn"></i><span class="break"></span><?= $text_alerts ?></h2>
                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>

            <div class="box-content alerts">
                <?php foreach ($messages as $message): ?>
                    <div class="alert <?= $message[1] ?>">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong><?= $message[0] ?></strong>
                    </div>
                <?php endforeach; ?>
            </div>


        </div><!--/span-->
    </div><!--/row-->

<?php  } ?>






