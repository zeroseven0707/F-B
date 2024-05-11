<?php

namespace App\Http\Controllers;

use App\Models\Vouchers;
use App\Models\VouchersHistories;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Vouchers::all();
        return response()->json(['data' => $vouchers], 200);
    }

    public function show($type)
    {
        $voucher = Vouchers::where('type',$type)->get();

        if (!$voucher) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }

        return response()->json(['data' => $voucher], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'price_total' => 'required',
            'member_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $voucher = Vouchers::where('code',$request->code)->first();
        if ($voucher->qty <= 0) {
            return response()->json(['error' => 'voucher telah habis'], 400);
        }
        $cek_limit = VouchersHistories::where('member_id',$request->member_id)->count();
        if ($cek_limit > $voucher->usage_limits) {
            return response()->json(['error' => 'voucher mencapai batas limit pemakaian'], 400);
        }
        if ($request->price_total < $voucher->min_spend) {
            return response()->json(['error' => 'minimal pembelian adalah Rp.'.number_format($voucher->min_spend)], 400);
        }
        $VouchersHistories = VouchersHistories::create([
            'voucher_id'=>$voucher->id,
            'member_id'=>$request->member_id,
            'date'=>Carbon::now()
        ]);
        if ($VouchersHistories) {
            Vouchers::where('code',$request->code)->update([
                'qty'=>($voucher->qty - 1)
            ]);
        }

        return response()->json(['data' => [
            'harga_sebelumnya' => $request->price_total,
            'potongan' => $voucher->min_spend,
            'total' => ($request->price_total-$voucher->min_spend),
        ]], 201);
    }

    public function update(Request $request, $id)
    {
        $voucher = VouchersHistories::where('order_id',$id)->first();

        if (!$voucher) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }
        $voucher->update([
            'status'=>'done'
        ]);

        return response()->json(['data' => $voucher], 200);
    }

    public function destroy($id)
    {
        $voucher = Vouchers::find($id);

        if (!$voucher) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }

        $voucher->delete();

        return response()->json(['message' => 'Voucher deleted'], 200);
    }
}
