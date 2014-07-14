<div class="pull-right" style="width: 355px; overflow: hidden; border: 1px solid transparent">

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
    <a href="<?php echo get_admin_url() ?>admin.php?page=ModerateReviews">
        Moderate Reviews
    </a>
    <span style="margin: 0 5px;">|</span>
    <a href="<?php echo get_admin_url() ?>admin.php?page=CustomizeTheme">
        Customize Theme
    </a>
    <span style="margin: 0 5px;">|</span>
    <a href="<?php echo get_admin_url() ?>admin.php?page=Seo">
        SEO
    </a>
    <span style="margin: 0 5px;">|</span>
    <a href="<?php echo get_admin_url() ?>admin.php?page=Settings">
        Settings
    </a>
</div>

