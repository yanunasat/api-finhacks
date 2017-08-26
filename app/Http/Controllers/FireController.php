<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fire;
use App\User;

class FireController extends Controller
{
    public function getTopup()
    {
        return Fire::where('type_pay', 'topup');
    }

    public function getTransfer()
    {
        return Fire::where('type_pay', 'transfer');
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
            $res['message'] = 'Successfully Topup';
            $res['data']    = $create;
        }
        else
        {
            $res['success'] = false;
            $res['message'] = 'Filed to topup';
        }

        return response()->json($res);
    }

    public function transfer(Request $request)
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
            'type_pay'  => 'transfer',
            'status'    => 1
        ]);

        if($create)
        {
            User::where('id', $user_id)
                ->update([
                    'balance' => ($user->balance - $amount)
                ]);
            $res['success'] = true;
            $res['message'] = 'Successfully Transfer';
            $res['data']    = $create;
        }
        else
        {
            $res['success'] = false;
            $res['message'] = 'Filed to transfer';
        }

        return response()->json($res);
    }
}
