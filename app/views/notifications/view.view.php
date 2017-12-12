<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <form action="" class="appForm" method="post">
                <table>
                    <tr>
                        <td>
                            <p><?= nl2br($notification->content) ?></p>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <footer>
            <p><?= $text_footer ?></p>
        </footer>
    </div>
</div>


<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">Messages</a></li>
</ul>

<div class="row-fluid">

    <div class="box span12" onTablet="span12" onDesktop="span12">
        <div class="box-header">
            <h2><i class="halflings-icon white comment"></i><span class="break"></span><?= $mail->Title ?></h2>
            <div class="box-icon">
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <ul class="chat">
                <li class="left">

                    <span class="message"><span class="arrow"></span>
                        <span class="time"><?= $notification->Created ?></span>
                        <span class="text">

                              <?= stripslashes(htmlspecialchars(nl2br($mail->Content))) ?>
                        </span>
                    </span>
                </li>
            </ul>
            <div class="chat-form">
                <a class="btn btn-info" href="/mails" title=""><i class="icon-arrow-up"></i></a>
                <a class="btn btn-info" href="/mails/reply/<?= $notification->Id ?>" title="<?= $text_table_control_reply ?>"><i class="icon-reply"></i></a>
                <a class="btn btn-info" href="/mails/forward/<?= $notification->Id ?>" title="<?= $text_table_control_forward ?>"><i class="icon-arrow-up"></i></a>
                <a class="btn btn-info" href="/mails/delete/<?= $notification->Id ?>/?token=<//?= $this->session->CSRFToken ?>" title="<?= $text_table_control_delete ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="icon-trash"></i></a>

            </div>
        </div>
    </div><!--/span-->

</div>
