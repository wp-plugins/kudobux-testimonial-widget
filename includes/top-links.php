<div class="pull-right other-links-div" style="width: 400px !important; overflow: hidden; border: 1px solid transparent">
    <div style="margin-right: 20px; text-align: right; margin-bottom: 10px;">
        <a href="https://kudobuzz.com/login-dashboard?uid=<?php echo $user_id?>" target="_blank">Open Kudobuzz outside Wordpress</a>
    </div>
    <a href="javascript:;" class="btn btn-xs btn-warning social-accounts-btn" id="social-accounts-btn">Add Social Account</a>
    <span style="margin: 0 5px"></span>
    <a href="<?php echo get_admin_url() ?>admin.php?page=AddCustomReview" class="btn btn-xs btn-warning">Add Custom Reviews</a>
    <span style="margin: 0 5px"></span>
    <?php
    if ($plan === '0') {
        ?>
        <a href="javascript:;" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal">UPGRADE</a>
        <?php
    } else {
        ?>

        <?php
    }
    ?>

</div>
<div class="pull-right" style="padding: 5px 50px 0 0; text-transform: uppercase;">
    <a href="<?php echo get_admin_url() ?>admin.php?page=ModerateReviews" style="<?php echo $_GET['page'] == 'ModerateReviews'?'color: #e87e04 !important':''?>">
        Moderate Reviews
    </a>
    <span style="margin: 0 5px;">|</span>
    <a href="<?php echo get_admin_url() ?>admin.php?page=CustomizeTheme" style="<?php echo ($_GET['page'] == 'CustomizeTheme' || $_GET['page'] == 'FullPageWidget') ?'color: #e87e04 !important':''?>">
        Customize Theme
    </a>
    <span style="margin: 0 5px;">|</span>
    <a href="<?php echo get_admin_url() ?>admin.php?page=Seo" style="<?php echo $_GET['page'] == 'Seo'?'color: #e87e04 !important':''?>">
        SEO
    </a>
    <span style="margin: 0 5px;">|</span>
    <a href="<?php echo get_admin_url() ?>admin.php?page=Settings" style="<?php echo ($_GET['page'] == 'Settings' || $_GET['page']=='Translation') ?'color: #e87e04 !important':''?>">
        Settings
    </a>
</div>

<?php include 'payment-modal.php';?>

