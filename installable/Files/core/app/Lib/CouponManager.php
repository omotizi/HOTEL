<?php

namespace App\Lib;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\RoomType;


class CouponManager
{

    public function getCouponByCode(string $code, $user = null)
    {
        return Coupon::activeAndValid()->matchCode($code)
            ->with(['roomTypes'])
            ->withCount('appliedCoupons')
            ->withCount(['appliedCoupons as user_applied_count' => function ($appliedCoupon) use ($user) {
                $appliedCoupon->where('user_id', $user ? $user->id : null);
            }])->first();
    }


    public function isValidCoupon($coupon, $cartTotal, $cartsData = null, $roomTypeId = null)
    {
        $general      = gs();
        $minimumSpend = $coupon->minimum_spend;
        $maximumSpend = $coupon->maximum_spend;

        // Check Minimum Subtotal
        if ($minimumSpend && $cartTotal < $minimumSpend) {
            return ['error' => " You have to booking a minimum amount of $minimumSpend $general->cur_text to avail yourself of this coupon."];
        }

        // Check Maximum Subtotal
        if ($maximumSpend && $cartTotal > $maximumSpend) {
            return ['error' => " You have to booking a maximum amount of $maximumSpend $general->cur_text to avail yourself of this coupon."];
        }

        //Check Limit Per Coupon
        if ($coupon->usage_limit_per_coupon && $coupon->applied_coupons_count >= $coupon->usage_limit_per_coupon) {
            return ['error' => "This coupon has exceeded the maximum limit for usage"];
        }

        //Check Limit Per User
        if ($coupon->usage_limit_per_user && $coupon->user_applied_count >= $coupon->usage_limit_per_user) {
            return ['error' => "You have already reached the maximum usage limit for this coupon"];
        }

        $couponProducts    = $coupon->roomTypes->pluck('id')->toArray();

        if ($cartsData) {
            $cartsData = $this->getCart();
            $cartProducts      = $cartsData->pluck('room_type_id')->unique()->toArray();
        }

        if ($roomTypeId) {
            $cartProducts      = $roomTypeId;
        }

        $missingProductsId   = array_diff($cartProducts, $couponProducts);
        if ($missingProductsId) {
            return ['error' => "This coupon isn't valid for some of the room types you've selected."];
        }

        // check exclude sale item room type
        if ($coupon->exclude_sale_items) {
            $invalidProducts = RoomType::whereIn('id', $cartProducts)
                ->whereHasOffer()
                ->select('id', 'name')
                ->get();
            if ($invalidProducts->isNotEmpty()) {
                return ['error' => "This coupon isn't valid for some of the room types you've selected."];
            }
        }

        return true;
    }

    private function getCart()
    {
        return $this->userCartQuery()->with('roomType')->latest()->get();
    }

    private function userCartQuery()
    {
        $cartData = Cart::HasRoomType();

        if (auth()->id()) {
            return $cartData->where('user_id', auth()->id());
        }

        return $cartData->where('session_uid', session('room_cart'));
    }
}
