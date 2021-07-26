<?php
// [REQUIRE] //
require_once('./vendor/autoload.php');


class StripeWrapper {
	public function createCardToken() {
		$stripe = new \Stripe\StripeClient('sk_test_4eC39HqLyjWDarjtT1zdp7dc');
		
		$tokenObj = $stripe->tokens->create([
			'card' => [
				'number' => '4242424242424242',
				'exp_month' => 7,
				'exp_year' => 2022,
				'cvc' => '314',
			],
		]);

		return $tokenObj;
	}
}