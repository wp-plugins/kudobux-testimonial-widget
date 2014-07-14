<?php

$kdwp = new Kudobuzzwp();

if($page == NULL){
    $page = 1;
}
if($total_connected == NULL){
    $total_connected = 0;
}
//var_dump($page);
//var_dump(count($feeds));
//var_dump($total_connected);
?>
<table class="table table-hover table-striped <?php echo ((int) $page > 0 && count($feeds) == 0) ? 'hide' : '' ?>" style="width: 100%; font-size: 12px;">
    <?php
    if (count($feeds) > 0) {
        foreach ($feeds as $feed) {
            
            if ($feed->source == 'tw') {
                $channel_id = 1;
            } elseif ($feed->source == 'fb') {
                $channel_id = 2;
            } elseif ($feed->source == 'cs') {
                $channel_id = 3;
            } elseif ($feed->source == 'ins') {
                $channel_id = 10;
            }
            elseif ($feed->source == 'sh') {
                $channel_id = 8;
            }
            
            ?>
            <tr id="<?php echo $feed->entity_id ?>">
                <td class="col-md-1">
                    <div class="rateit" data-rateit-value="<?php echo $feed->rating == NULL ? 0 : $feed->rating ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                    <input type="hidden" value="<?php echo $feed->rating == NULL ? 0 : $feed->rating ?>" class="rating-value"  />
                </td>
                <td class="col-md-4" style="position: relative; overflow: hidden">
                    <img src="<?php echo $feed->avatar ?>" class="avatar img-thumbnail img-rounded custom-img-thumbnail from_user_img" />
                    <div class="review-desc">
                        <span class="from_user_name">
                            <?php echo $feed->name ?>
                        </span>
                        <div class="from_twitter_message">
                            <?php echo stripslashes($feed->message) ?>
                        </div>
                        <input id="channel" type="hidden" value="<?php echo $channel_id ?>" />
                    </div>
                </td>
                <td class="col-md-1 feed-date created_at"><?php echo date("M d, Y", strtotime($feed->created_at)) ?></td>
                <td class="col-md-1 feed-status" style="text-align: center">
                    <!-- Standard button -->
                    <span class="feed-statu label label-<?php echo $feed->is_kudos == 1 ? 'success' : 'danger' ?>"><?php echo $feed->is_kudos == 1 ? 'Published' : 'Unpublished' ?></span>
                </td>
                <td class="col-md-1" style="padding-top: 15px; text-align: center">
                    <button type="button" class="btn btn-xs btn-default unpublish <?php echo $feed->is_kudos == 1 ? '':'hide'?>" onclick="remove_kudo('<?php echo $feed->entity_id ?>', '<?php echo $feed->source ?>', '<?php echo $feed->id ?>')">Unpublish</button>
                    <button type="button" class="btn btn-xs btn-default publish <?php echo $feed->is_kudos == 1 ? 'hide' : '' ?>">Publish</button>
                    <?php
                    if ($feed->is_kudos == 1) {
                        ?>
                        
                        <?php
                    } else {
                        ?>
                        
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
    } else {
        ?>
        	<!-- NO SOCIAL ACCOUNT, NO SOCIAL FEEDS -->
            <div class="alert alert-warning <?php echo (((int) $page == 0 || (int) $page == 1) && count($feeds) == 0 && $total_connected == 0 && $category == 'social' && ($type == 'suggested' || $type == 'all' || $type == 'unpublished' || $type == 'published')) ? '' : 'hide' ?>" style="margin-top: 20px;">You have not connected any account. <a href="javascript:;" class="social-accounts-btn">Add Social Account</a></div>
            
            <!-- NO CUSTOM REVIEW -->
            <div class="alert alert-warning <?php echo (((int) $page == 0 || (int) $page == 1) && count($feeds) == 0 && $total_connected == 0 && $category == 'custom' && ($type == 'suggested' || $type == 'all' || $type == 'unpublished' || $type == 'published')) ? '' : 'hide' ?>" style="margin-top: 20px;">There is no custom review. Click <a href="<?php echo get_admin_url() ?>admin.php?page=AddCustomReview">here</a> to add some</div>
            
            <!-- NO WEBSITE REVIEW -->
            <div class="alert alert-warning <?php echo (((int) $page == 0 || (int) $page == 1) && count($feeds) == 0 && $total_connected == 0 && $category == 'website' && ($type == 'suggested' || $type == 'all' || $type == 'unpublished' || $type == 'published')) ? '' : 'hide' ?>" style="margin-top: 20px;">You did not receive any website review.</div>
            
            
            <div class="alert alert-warning <?php echo (((int) $page == 0 || (int) $page == 1) && count($feeds) == 0 && $total_connected > 0 && $category == 'social') ? '' : 'hide' ?>" style="margin-top: 20px;">This account(s) has no feed at the moment.</div>
        <?php
    }
    ?>
</table>