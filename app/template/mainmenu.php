<!-- start: Main Menu -->
<div id="sidebar-left" class="span2">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">


            <li>
                <a class="dropmenu" href="#"><i class="icon-credit-card"></i><span class="hidden-tablet">  <?= $text_dashboard ?></span></a>
                <ul>
                    <li><a class="submenu" href="/"><i class="icon-dashboard"></i><span class="hidden-tablet"> <?= @$text_dashboard ?> </span></a></li>

                    <li><a class="submenu" href="/statistics"><i class="icon-signal"></i><span class="hidden-tablet"> <?= $text_general_statistics ?> </span></a></li>

                </ul>
            </li>

            <li>
                <a class="dropmenu" href="#"><i class="icon-credit-card"></i><span class="hidden-tablet">  <?= $text_transactions ?></span></a>
                <ul>
                    <li><a class="submenu" href="/purchases"><i class="icon-gift"></i><span class="hidden-tablet"> <?= $text_transactions_purchases ?></span></a></li>
                    <li><a class="submenu" href="/sales"><i class="icon-briefcase"></i><span class="hidden-tablet"> <?= $text_transactions_sales ?></span></a></li>
                </ul>
            </li>

            <li>
                <a class="dropmenu" href="#"><i class="icon-money"></i><span class="hidden-tablet"> <?= $text_expenses ?></span></a>
                <ul>
                    <li><a class="submenu" href="/expensescategories"><i class="icon-list-ul"></i><span class="hidden-tablet"> <?= $text_expenses_categories ?></span></a></li>
                    <li><a class="submenu" href="/dailyexpenses"><i class="icon-credit-card"></i><span class="hidden-tablet"> <?= $text_expenses_daily_expenses ?></span></a></li>
                </ul>
            </li>

            <li>
                <a class="dropmenu" href="#"><i class="icon-home"></i><span class="hidden-tablet"> <?= @$text_store ?></span></a>
                <ul>
                    <li><a class="submenu" href="/productcategories"><i class="icon-list-alt"></i><span class="hidden-tablet"> <?= $text_store_categories ?></span></a></li>
                    <li><a class="submenu" href="/productlist"><i class="icon-tag"></i><span class="hidden-tablet"> <?= $text_store_products ?></span></a></li>
                </ul>
            </li>


            <li><a href="/clients"><i class="icon-user-md"></i><span class="hidden-tablet"> <?= @$text_clients ?></span></a></li>

            <li><a href="/suppliers"><i class="icon-group"></i><span class="hidden-tablet"> <?= $text_suppliers ?></span></a></li>


            <li>
                <a class="dropmenu" href="#"><i class="icon-user"></i><span class="hidden-tablet"> <?= @$text_users ?></span></a>
                <ul>
                    <li><a class="submenu" href="/users"><i class="icon-list"></i><span class="hidden-tablet"> <?= $text_users_list ?></span></a></li>
                    <li><a class="submenu" href="/usersgroups"><i class="icon-group"></i><span class="hidden-tablet"> <?= $text_users_groups ?></span></a></li>
                    <li><a class="submenu" href="/privileges"><i class="icon-key"></i><span class="hidden-tablet"> <?= $text_users_privileges ?></span></a></li>

                </ul>
            </li>

            <li>
                <a class="dropmenu" href="#"><i class="icon-envelope-alt"></i><span class="hidden-tablet"> <?= @$text_mails ?></span></a>
                <ul>
                    <li><a class="submenu" href="/mails/default"><i class="icon-inbox"></i><span class="hidden-tablet"> <?= $text_mails_inbox ?></span></a></li>
                    <li><a class="submenu" href="/mails/sent"><i class="icon-arrow-up"></i><span class="hidden-tablet"> <?= $text_mails_sent ?></span></a></li>
                </ul>
            </li>




            <li><a href="/reports"><i class="icon-bar-chart"></i><span class="hidden-tablet"> <?= $text_reports ?></span></a></li>
            <li><a href="/notifications"><i class="icon-bell"></i><span class="hidden-tablet"> <?= $text_notifications ?></span></a></li>
            <li><a href="/auth/logout"><i class="icon-signout"></i><span class="hidden-tablet"> <?= $text_log_out ?></span></a></li>
        </ul>
    </div>
</div>
<!-- end: Main Menu -->

<noscript>
    <div class="alert alert-block span10">
        <h4 class="alert-heading">Warning!</h4>
        <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
    </div>
</noscript>