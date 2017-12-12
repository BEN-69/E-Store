<?php $messages = $this->messenger->getMessages(); if(!empty($messages)){ ?>
    <div class="row-fluid">
        <div class="box span12">

            <div class="box-header">
                <h2><i class="halflings-icon white white bullhorn"></i><span class="break"></span>Alerts</h2>
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

<div class="container-fluid-full">
    <div class="row-fluid">
        <div class="row-fluid">
            <div class="login-box">
                <hr>
                <h2><?= $title ?></h2>
                <hr>

                <h3><?= $login_header ?></h3>
                <form class="form-horizontal" autocomplete="off" method="post" enctype="application/x-www-form-urlencoded">
                    <fieldset>

                        <div class="input-prepend" title="Username">
                            <span class="add-on"><i class="halflings-icon user"></i></span>
                            <input class="input-large span10" name="ucname" id="ucname" maxlength="50"
                                   placeholder="type <?= $login_ucname ?>" type="text"/>
                        </div>
                        <div class="clearfix"></div>

                        <div class="input-prepend" title="Password">
                            <span class="add-on"><i class="halflings-icon lock"></i></span>
                            <input class="input-large span10" type="password" id="ucpwd" name="ucpwd" maxlength="100"
                                   placeholder="type <?= $login_ucpwd ?>"/>
                        </div>
                        <div class="clearfix"></div>

                        <label class="remember" for="remember"><input type="checkbox" id="remember"/>Remember me</label>

                        <div class="button-login">
                            <button type="submit" class="btn btn-primary" name="login"><?= $login_button ?></button>
                        </div>
                        <div class="clearfix"></div>
                </form>
                <p>
                    No problem, <a href="#">click here</a> to get a new password.
                </p>
            </div><!--/span-->
        </div><!--/row-->


    </div><!--/.fluid-container-->

</div><!--/fluid-row-->


