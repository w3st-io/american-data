<?php
require('./api/stripe/index.php');


$s = new StripeWrapper();


$tokenObj = $s->createCardToken();


echo 'returned: '.$tokenObj;