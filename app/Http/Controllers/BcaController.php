<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BcaController extends Controller
{
    public function getRate()
    {
        $detail = DB::table('rate')
                    ->leftJoin('rate_detail', 'rate.id', '=', 'rate_id')
                    ->get();

        $rate   = DB::table('rate')->get();
        $data   = array();

        foreach ($rate as $item_rate) {
            $detail = DB::table('rate')
                        ->leftJoin('rate_detail', 'rate.id', '=', 'rate_id')
                        ->where('rate_id','=', $item_rate->id)
                        ->select('rate_type as RateType', 'buy', 'sell', 'last_update as LastUpdate')
                        ->get();
            $data[] = [
                'CurrencyCode' => $item_rate->code,
                'RateDetail'    => $detail
            ];
        }

        return response()->json([
            'Currencies' => $data,
            'InvalidRateType' => 'yy',
            'InvalidCurrencyCode' => 'xxx'
        ]);
    }
}
