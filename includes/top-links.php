<div class="pull-right other-links-div" style="width: 355px; overflow: hidden; border: 1px solid transparent">

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
    <a href="<?php echo get_admin_url() ?>admin.php?page=ModerateReviews" style="<?php echo $_GET['page'] == 'ModerateReviews'?'color: #e87e04':''?>">
        Moderate Reviews
    </a>
    <span style="margin: 0 5px;">|</span>
    <a href="<?php echo get_admin_url() ?>admin.php?page=CustomizeTheme" style="<?php echo $_GET['page'] == 'CustomizeTheme'?'color: #e87e04':''?>">
        Customize Theme
    </a>
    <span style="margin: 0 5px;">|</span>
    <a href="<?php echo get_admin_url() ?>admin.php?page=Seo" style="<?php echo $_GET['page'] == 'Seo'?'color: #e87e04':''?>">
        SEO
    </a>
    <span style="margin: 0 5px;">|</span>
    <a href="<?php echo get_admin_url() ?>admin.php?page=Settings" style="<?php echo $_GET['page'] == 'Settings'?'color: #e87e04':''?>">
        Settings
    </a>
</div>

<?php include 'payment-modal.php';?>

