<?php
// [REQUIRE] //
require_once('./vendor/autoload.php');


class StripeWrapper {
	public function createPaymentMethod($card_number, $card_exp_month, $card_exp_year, $card_cvc) {
		$stripe = new \Stripe\StripeClient('sk_test_51INvnfCC0rHo3XXZxdgGXsFDstmtEnCGYux6ZA8XlySkrSsYqHAa5kOFptGb8k2w6TtyOAuJhiBpeeTkXShldA6E00XuTKIQ3h');
		

		$tokenObj = $stripe->paymentMethods->create([
			'type' => 'card',
			'card' => [
				'number' => $card_number,
				'exp_month' => $card_exp_month,
				'exp_year' => $card_exp_year,
				'cvc' => $card_cvc,
			],
		]);


		return $tokenObj;
	}


	public function createCustomer($email, $phone, $payment_method) {
		$stripe = new \Stripe\StripeClient('sk_test_51INvnfCC0rHo3XXZxdgGXsFDstmtEnCGYux6ZA8XlySkrSsYqHAa5kOFptGb8k2w6TtyOAuJhiBpeeTkXShldA6E00XuTKIQ3h');


		// Create customer //
		$customerObj = $stripe->customers->create([
			'email' => $email,
			'phone' => $phone,
			'payment_method' => $payment_method,
		]);

		// Set Default payment method //
		$i['invoice_settings']['default_payment_method'] = $payment_method;
		
		$stripe->customers->update(
			$customerObj['id'],
			[$i]
		);

		return $customerObj;
	}


	public function createOneDollarCharge($customer) {
		$stripe = new \Stripe\StripeClient('sk_test_51INvnfCC0rHo3XXZxdgGXsFDstmtEnCGYux6ZA8XlySkrSsYqHAa5kOFptGb8k2w6TtyOAuJhiBpeeTkXShldA6E00XuTKIQ3h');


		$customerObj = $stripe->customers->retrieve(
			$customer,
			[]
		);


		$paymentIntentsObj = $stripe->paymentIntents->create([
			'amount' => 100,
			'currency' => 'usd',
			'payment_method' => $customerObj['invoice_settings']['default_payment_method'],
			'payment_method_types' => ['card'],
			'customer' => $customerObj['id']
		]);


		$paymentCompleteObj = $stripe->paymentIntents->confirm(
			$paymentIntentsObj['id'],
		);
		
		
		return $paymentCompleteObj;
	}
}