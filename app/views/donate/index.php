<?php

use yii\web\View;

/** @var View $this */
/** @var string $data */
/** @var string $signature */
?>

<section style="padding-top: 120px;"></section>

<section id="donation">
    <div class="container">
        <div class="row">
            <div id="liqpay_checkout"></div>
        </div>
    </div>

</section>

<div id="liqpay_checkout"></div>

<script>
  window.LiqPayCheckoutCallback = function() {
    LiqPayCheckout.init({
      data: "<?= $data ?>",
      signature: "<?= $signature ?>",
      embedTo: "#liqpay_checkout",
      language: "uk",
      mode: "embed" // embed || popup,
       }).on("liqpay.callback", function(data){
			console.log(data.status);
			console.log(data);
			}).on("liqpay.ready", function(data){
				// ready
			}).on("liqpay.close", function(data){
				// close
		});
  };
</script>
<script src="//static.liqpay.ua/libjs/checkout.js" async></script>