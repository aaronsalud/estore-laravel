<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public static function findByCode($code){
        return self::where('code', $code)->first();
    }
}
