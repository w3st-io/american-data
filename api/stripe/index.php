<?php
// [REQUIRE] //
require_once('./vendor/autoload.php');


include_once('./config/index.php');


class StripeWrapper {
	public function createPaymentMethod($card_number, $card_exp_month, $card_exp_year, $card_cvv) {
		try {
			$stripe = new \Stripe\StripeClient(STRIPE_KEY);
			

			
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
		catch (\Throwable $err) {
			echo $err;
		}
	}


	public function createCustomer($email, $phone, $payment_method, $street, $city, $state, $zip) {
		try {
			$stripe = new \Stripe\StripeClient(STRIPE_KEY);

			// [INIT] //
			$i['address']['line1'] = $street;
			$i['address']['city'] = $city;
			$i['address']['state'] = $state;
			$i['address']['postal_code'] = $zip;
			$i['address']['country'] = 'usa';

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
		catch (\Throwable $err) {
			echo $err;
		}
	}


	public function createOneDollarCharge($cus_id, $vin) {
		try {
			$stripe = new \Stripe\StripeClient(STRIPE_KEY);


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
		catch (\Throwable $err) {
			echo $err;
		}
	}


	public function createSubscription($cus_id) {
		try {
			$stripe = new \Stripe\StripeClient(STRIPE_KEY);


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
		catch (\Throwable $err) {
			echo $err;
		}
	}


	public function retrieveSubscription($sub_id) {
		try {
			$stripe = new \Stripe\StripeClient(STRIPE_KEY);


			// [SUBSCRIPTION] Retrieve //
			$subObj = $stripe->subscriptions->retrieve($sub_id, []);


			return $subObj;
		}
		catch (\Throwable $err) {
			echo $err;
		}
	}


	public function retrieveDefaultPaymentMethod($cus_id) {
		try {
			$stripe = new \Stripe\StripeClient(STRIPE_KEY);
	
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
		catch (\Throwable $err) {
			echo $err;
		}
	}


	public function updateDefaultPaymentMethod(
		$cus_id,
		$card_number,
		$card_exp_month,
		$card_exp_year,
		$card_cvv
	) {
		try {
			$stripe = new \Stripe\StripeClient(STRIPE_KEY);

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
		catch (\Throwable $err) {
			echo $err;
		}
	}


	public function retrievePaymentIntent($pi_id) {
		try {
			$stripe = new \Stripe\StripeClient(STRIPE_KEY);

			$piObj = $stripe->paymentIntents->retrieve(
				$pi_id,
				[]
			);

			return $piObj;
		}
		catch (\Throwable $err) {
			echo $err;
		}
	}
}