<div class="modal fade upgrade-form" id="myModal" tabindex="999" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Kudobuzz Pricing Plans</h4>
            </div>
            <div class="modal-body">
                <div style="width: 100%; overflow: hidden">
                    <div class="plan-div free-plan-div">
                        <div id="title">
                            Free Plan
                        </div>
                        <div id="plan-price">
                            <p id="price-desc">
                                <span style="font-size: 20px; vertical-align: top; color: #CDC7C4">$</span>
                                <span id="price-tag">0</span><br>
                                <span style="color: #CDC7C4">Per Month</span>
                            </p>
                        </div>
                        <div id="content">
                            <div id="feature">
                                1 Social Account
                            </div>
                            <div id="feature">
                                10 Social Reviews
                            </div>
                            <div id="feature"  style="border: 0">
                                Unlimited Custom Reviews
                            </div>
                        </div>
                        <div class="btn-div">
                            <input type="button" class="btn btn-default" value="Total Free" style="width: 100px" />
                        </div>
                    </div>

                    <div class="plan-div free-plan-div">
                        <div id="title">
                            Professional
                        </div>
                        <div id="plan-price">
                            <p id="price-desc">
                                <span style="font-size: 20px; vertical-align: top; color: #CDC7C4">$</span>
                                <span id="price-tag">4.99</span><br>
                                <span style="color: #CDC7C4">Per Month</span>
                            </p>
                        </div>

                        <div id="content">
                            <div id="feature">
                                Unlimited Social Accounts
                            </div>
                            <div id="feature">
                                Unlimited Social Reviews
                            </div>
                            <div id="feature">
                                Unlimited Custom Reviwes
                            </div>
                            <div id="feature">
                                Google Rich Snippet
                            </div>
                            <div id="feature">
                                Advance Widget Customization
                            </div>
                            <div id="feature"  style="border: 0; width: 205px; margin: 0 auto">

                                <div class="pull-left" style="margin-right: 10px">
                                    <label class="">
                                        <input type="radio" name="pro-price" value="monthly" checked="true">
                                        Monthly
                                    </label>
                                </div>

                                <div class="pull-left">                         
                                    <label class="">
                                        <input type="radio" name="pro-price" value="yearly">
                                        Yearly
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="btn-div">
                            <script src="https://checkout.stripe.com/checkout.js"></script>

                            <button id="professional" class="btn btn-default">Purchase</button>
                            <input type="hidden" id="hidden-pricing" value="4.99" />
                            <input type="hidden" id="hidden-pricing-desc" value="1 Month Professional Plan" />
                            <input type="hidden" id="hidden-pricing-duration" value="30" />
                            <input type="hidden" id="hidden-pricing-plan" value="3" />
                            <input type="hidden" id="hidden-plan-id" value="100" />

                            <script>
                                var handler = StripeCheckout.configure({
                                    key: '<?php echo STRIPE_PUBLISHABLE_KEY ?>',
                                    image: '../wp-content/plugins/kudobux-testimonial-widget/assets/img/kudobuzz-logo.png',
                                    token: function(token) {
                                        var params = {
                                            'token': token,
                                            'uid': '<?php echo $kd_uid ?>',
                                            'payment_duration': jQuery("#hidden-pricing-duration").val(),
                                            'payment_plan': jQuery("#hidden-pricing-plan").val(),
                                            'amount': jQuery("#hidden-pricing").val() * 100,
                                            'plan_id': jQuery("#hidden-plan-id").val()
                                        };
                                        jQuery(".upgrade-form").modal("hide");
                                        bootbox.dialog({
                                            message: '<div class="upgrade-modal-div"><div style="text-align: center; padding: 20px 0"><img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader-big.gif" /></div></div>',
                                            title: "Upgrading...",
                                            className: 'small-modal'
                                        });
                                        jQuery(".small-modal .bootbox-close-button").addClass("hide");
                                        jQuery.ajax({
                                            url: '<?php echo API_DOMAIN ?>api/plan/upgrade',
                                            type: 'POST',
                                            data: params,
                                            success: function(result) {

                                                jQuery(".small-modal .modal-title").html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png" style="margin-right: 5px;" />Success');
                                                jQuery(".upgrade-modal-div").html("<h3>Success!</h3><p>Your account has been successfully upgraded. Please click the button below to complete the process.</p><a href='javascript:;' onclick='location.reload();' class='btn btn-primary'>Done</a>");
                                            }
                                        });
                                    }
                                });

                                document.getElementById('professional').addEventListener('click', function(e) {
                                    // Open Checkout with further options
                                    handler.open({
                                        name: 'Kudobuzz',
                                        description: jQuery("#hidden-pricing-desc").val() + ' ($' + jQuery("#hidden-pricing").val() + ')',
                                        amount: jQuery("#hidden-pricing").val() * 100
                                    });
                                    e.preventDefault();
                                });
                            </script>
                        </div>
                    </div>

                    <div class="plan-div pro-plan-div" style="margin: 0">
                        <div id="title">
                            Lifetime
                        </div>
                        <div id="plan-price">
                            <p id="price-desc">
                                <span style="font-size: 20px; vertical-align: top; color: #CDC7C4">$</span>
                                <span id="price-tag">99.99</span><br>
                                <span style="color: #CDC7C4">One time, Life time</span>
                            </p>
                        </div>

                        <div id="content">
                            <div id="feature">
                                Unlimited Social Accounts
                            </div>
                            <div id="feature">
                                Unlimited Social Reviews
                            </div>
                            <div id="feature">
                                Unlimited Custom Reviwes
                            </div>
                            <div id="feature">
                                Google Rich Snippet
                            </div>
                            <div id="feature" style="border: 0">
                                Advance Widget Customization
                            </div>
                        </div>

                        <div class="btn-div">
                            <script src="https://checkout.stripe.com/checkout.js"></script>

                            <button id="lifetime" class="btn btn-default">Purchase</button>

                            <script>
                                var handler_2 = StripeCheckout.configure({
                                    key: '<?php echo STRIPE_PUBLISHABLE_KEY ?>',
                                    image: '../wp-content/plugins/kudobux-testimonial-widget/assets/img/kudobuzz-logo.png',
                                    token: function(token) {
                                        var params = {
                                            'token': token,
                                            'uid': '<?php echo $kd_uid ?>',
                                            'payment_duration': 1826,
                                            'payment_plan': 7, //Unlimited
                                            'amount': 99.99 * 100
                                        };
                                        jQuery(".upgrade-form").modal("hide");
                                        bootbox.dialog({
                                            message: '<div class="upgrade-modal-div"><div style="text-align: center; padding: 20px 0"><img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader-big.gif" /></div></div>',
                                            title: "Upgrading...",
                                            className: 'small-modal'
                                        });
                                        jQuery(".small-modal .bootbox-close-button").addClass("hide");
                                        jQuery.ajax({
                                            url: '<?php echo API_DOMAIN ?>api/plan/upgrade',
                                            type: 'POST',
                                            data: params,
                                            success: function(result) {

                                                jQuery(".small-modal .modal-title").html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png" style="margin-right: 5px;" />Success');
                                                jQuery(".upgrade-modal-div").html("<h3>Success!</h3><p>Your account has been successfully upgraded. Please click the button below to complete the process.</p><a href='javascript:;' onclick='location.reload();' class='btn btn-primary'>Done</a>");
                                            }
                                        });
                                    }
                                });

                                document.getElementById('lifetime').addEventListener('click', function(e) {
                                    // Open Checkout with further options
                                    handler_2.open({
                                        name: 'Kudobuzz',
                                        description: 'One time, Life time',
                                        amount: 99.99 * 100
                                    });
                                    e.preventDefault();
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer hide">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>