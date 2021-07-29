<?php
// [REQUIRE] //
require_once('./vendor/autoload.php');


class StripeWrapper {
	public function createPaymentMethod($card_number, $card_exp_month, $card_exp_year, $card_cvv) {
		$stripe = new \Stripe\StripeClient('sk_test_51INvnfCC0rHo3XXZxdgGXsFDstmtEnCGYux6ZA8XlySkrSsYqHAa5kOFptGb8k2w6TtyOAuJhiBpeeTkXShldA6E00XuTKIQ3h');
		

		
		// [PAYMENT-METHOD][CREATE] //
		$pmObj = $stripe->paymentMethods->create([
			'type' => 'card',
			'card' => [
				'number' => $card_number,
				'exp_month' => $card_exp_month,
				'exp_year' => $card_exp_year,
				'cvc' => $card_cvv,
			],
		]);


		return $pmObj;
	}


	public function createCustomer($email, $phone, $payment_method) {
		$stripe = new \Stripe\StripeClient('sk_test_51INvnfCC0rHo3XXZxdgGXsFDstmtEnCGYux6ZA8XlySkrSsYqHAa5kOFptGb8k2w6TtyOAuJhiBpeeTkXShldA6E00XuTKIQ3h');


		// [CUSTOMER][CREATE] //
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


	public function createOneDollarCharge($cus_id, $vin) {
		$stripe = new \Stripe\StripeClient('sk_test_51INvnfCC0rHo3XXZxdgGXsFDstmtEnCGYux6ZA8XlySkrSsYqHAa5kOFptGb8k2w6TtyOAuJhiBpeeTkXShldA6E00XuTKIQ3h');


		// [CUSTOMER] //
		$customerObj = $stripe->customers->retrieve(
			$cus_id,
			[]
		);
		

		// [PAYMENT-INTENT] //
		$paymentIntentsObj = $stripe->paymentIntents->create([
			'amount' => 100,
			'currency' => 'usd',
			'payment_method' => $customerObj['invoice_settings']['default_payment_method'],
			'payment_method_types' => ['card'],
			'customer' => $cus_id,
			"metadata" => ["vin" => $vin]
		]);


		// [PAYMENT-CONFIRM] //
		$paymentCompleteObj = $stripe->paymentIntents->confirm(
			$paymentIntentsObj['id'],
		);
		
		
		return $paymentCompleteObj;
	}


	public function createSubscription($cus_id) {
		$stripe = new \Stripe\StripeClient('sk_test_51INvnfCC0rHo3XXZxdgGXsFDstmtEnCGYux6ZA8XlySkrSsYqHAa5kOFptGb8k2w6TtyOAuJhiBpeeTkXShldA6E00XuTKIQ3h');


		// [SUBSCRIPTION] Create //
		$subObj = $stripe->subscriptions->create([
			'customer' => $cus_id,
			'trial_period_days' => 30,
			'items' => [
				['price' => 'price_1JI4vPCC0rHo3XXZsvXKOQz2'],
			],
		]);


		return $subObj;
	}


	public function retrieveSubscription($sub_id) {
		$stripe = new \Stripe\StripeClient('sk_test_51INvnfCC0rHo3XXZxdgGXsFDstmtEnCGYux6ZA8XlySkrSsYqHAa5kOFptGb8k2w6TtyOAuJhiBpeeTkXShldA6E00XuTKIQ3h');


		// [SUBSCRIPTION] Retrieve //
		$subObj = $stripe->subscriptions->retrieve($sub_id, []);


		return $subObj;
	}


	public function retrieveDefaultPaymentMethod($cus_id) {
		$stripe = new \Stripe\StripeClient('sk_test_51INvnfCC0rHo3XXZxdgGXsFDstmtEnCGYux6ZA8XlySkrSsYqHAa5kOFptGb8k2w6TtyOAuJhiBpeeTkXShldA6E00XuTKIQ3h');

		// [CUSTOMER] //
		$customerObj = $stripe->customers->retrieve(
			$cus_id,
			[]
		);

		$currentPmObj = $customerObj['invoice_settings']['default_payment_method'];

		$pmDetailsObj = $stripe->paymentMethods->retrieve(
			$currentPmObj,
			[]
		);

		return $pmDetailsObj;
	}


	public function updateDefaultPaymentMethod(
		$cus_id,
		$card_number,
		$card_exp_month,
		$card_exp_year,
		$card_cvv
	) {
		$stripe = new \Stripe\StripeClient('sk_test_51INvnfCC0rHo3XXZxdgGXsFDstmtEnCGYux6ZA8XlySkrSsYqHAa5kOFptGb8k2w6TtyOAuJhiBpeeTkXShldA6E00XuTKIQ3h');

		echo $card_exp_year;


		// [PAYMENT-METHOD][CREATE] //
		$pmObj = $stripe->paymentMethods->create([
			'type' => 'card',
			'card' => [
				'number' => $card_number,
				'exp_month' => $card_exp_month,
				'exp_year' => $card_exp_year,
				'cvc' => $card_cvv,
			],
		]);


		$stripe->paymentMethods->attach(
			$pmObj['id'],
			['customer' => $cus_id]
		);


		// Set Default payment method //
		$i['invoice_settings']['default_payment_method'] = $pmObj['id'];
		
		$stripe->customers->update(
			$cus_id,
			[$i]
		);
	}


	public function retrievePaymentIntent($pi_id) {
		$stripe = new \Stripe\StripeClient('sk_test_51INvnfCC0rHo3XXZxdgGXsFDstmtEnCGYux6ZA8XlySkrSsYqHAa5kOFptGb8k2w6TtyOAuJhiBpeeTkXShldA6E00XuTKIQ3h');

		$piObj = $stripe->paymentIntents->retrieve(
			$pi_id,
			[]
		);

		return $piObj;
	}
}