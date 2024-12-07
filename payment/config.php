<?php
    $stripe_secret_key = "sk_test_51QNYDQBZkVXMDfwqstMCd2mV64Brq56ESWzBj0ndfuUVVvwyuK7AVntA1bxTjE7IIzhZU80W2EYLvAA3SIysUcK800kHwvsaFn";

    \Stripe\Stripe::setApiKey($stripe_secret_key);
?>