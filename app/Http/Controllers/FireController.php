<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fire;
use App\User;

class FireController extends Controller
{
    public function topup(Request $request)
    {
        $user_id    = $request->input('user_id');
        $wallet_id  = $request->input('wallet_id');
        $amount     = $request->input('amount');
        $type       = $request->input('type');
        $status     = $request->input('status');

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
		}

        $create = Fire::create([
            'user_id'   => $user_id,
            'wallet_id' => $wallet_id,
            'amount'    => $amount,
            'type_pay'  => $type,
            'status'    => $status
        ]);

        if($create)
        {
            User::where('id', $user_id)
                ->update([
                    'amount' => ($user->amount + $amount)
                ])
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
