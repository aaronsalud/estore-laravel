<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Jobs\UpdateDiscount;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CouponsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon  = Coupon::where('code', $request->coupon_code)->first();
        
        if(!$coupon){
            Alert::toast('Invalid coupon code. Please try again','error');
            return back();
        }

        dispatch_now(new UpdateDiscount($coupon));

        Alert::toast('Discount coupon has been applied!','success');

        if(!auth()->user()){
            return redirect()->route('guestCheckout.index');
        }

        return redirect()->route('checkout');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');
        Alert::toast('Discount coupon has been removed','success');

        if(!auth()->user()){
            return redirect()->route('guestCheckout.index');
        }

        return redirect()->route('checkout');
    }
}
