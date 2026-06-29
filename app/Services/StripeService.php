<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Charge;
use Exception;

class StripeService
{
    /**
     * Thực hiện thanh toán qua Stripe
     *
     * @param float $amount
     * @param string $token
     * @param string $description
     * @return Charge
     * @throws Exception
     */
    public function charge(float $amount, string $token, string $description = 'Cảm ơn vì đã thanh toán trước')
    {
        $stripeSecret = env('STRIPE_SECRET');
        if (empty($stripeSecret)) {
            throw new Exception('Chưa cấu hình STRIPE_SECRET trong file .env');
        }

        Stripe::setApiKey($stripeSecret);

        return Charge::create([
            "amount" => $amount * 100, // Stripe tính bằng cent
            "currency" => "usd",
            "source" => $token,
            "description" => $description
        ]);
    }
}
