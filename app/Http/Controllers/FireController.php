<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fire;
use App\User;

class FireController extends Controller
{
    public function getTopup()
    {
        return Fire::all();
    }

    public function topup(Request $request)
    {
        $res        = array();
        $user_id    = $request->input('user_id');
        $wallet_id  = $request->input('wallet_id');
        $amount     = (int) $request->input('amount');

        if(empty($wallet_id))
        {
            $res['success'] = false;
            $res['message'] = 'wallet id incorrect!';

            return response()->json($res);
        }

        if(empty($user_id))
        {
            $res['success'] = false;
            $res['message'] = 'user Id incorrect!';

            return response()->json($res);
        }

        $user = User::findOrFail($user_id);
		if(!$user)
		{
			$res['success'] = false;
			$res['message'] = 'Cannot find user!';
            return response()->json($res);
		}

        $create = Fire::create([
            'wallet_id' => $wallet_id,
            'user_id'   => $user_id,
            'amount'    => $amount,
            'type_pay'  => 'topup',
            'status'    => 1
        ]);

        if($create)
        {
            User::where('id', $user_id)
                ->update([
                    'balance' => ($user->balance + $amount)
                ]);
            $res['success'] = true;
            $res['message'] = 'Successfully Created';
            $res['data']    = $create;
        }
        else
        {
            $res['success'] = false;
            $res['message'] = 'Filed to create';
        }

        return response()->json($res);
    }
}
