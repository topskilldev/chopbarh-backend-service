<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 20.01.20
 * Time: 17:19
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RefundDispute;
use App\Models\Refund;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Validation\ValidationException;

class RefundController extends Controller
{
    public function add(Request $request) {
        $result = array();
        $statusCode = Response::HTTP_OK;

        try {
            $request->validate([
                'amount' => 'required|numeric',
                'bank' => 'required',
                'customer_id' => 'required',
                'refund_date' => 'required',
                'paid_at' => 'required|numeric',
                'playerId' => 'required',
                'status' => 'required',
                'transaction_reference' => 'unique:refunds'
            ]);

            $refund = new Refund();
            $refund->fill($request->all());
            if ($refund->save()) {
                $result['status'] = true;
                $result['message'] = "Refund successfully recorded";
            } else {
                $result['status'] = false;
                $result['message'] = "Action was not carried out due to an error";
                $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
            }
        } catch (ValidationException $exception) {
            $result['status'] = false;
            $result['message'] = $exception->errors();
            $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
        }

        return response()->json($result, $statusCode);
    }

    public function get($playerId, Request $request) {
        $pageSize = 15;

        if ($request->has('pageSize')) {
            $pageSize = $request->pageSize;
        }
        $pagedData = Refund::where('playerId', $playerId)->paginate($pageSize);

        return response()->json($pagedData);
    }

    public function dispute(Request $request) {
        $result = array();
        $statusCode = Response::HTTP_OK;

        try {
            $request->validate([
                'amount' => 'required|numeric',
                'bank' => 'required',
                'customer_id' => 'required',
                'refund_date' => 'required',
                'gateway' => 'required',
                'playerId' => 'required',
                'status' => 'required',
                'transaction_reference' => 'unique:refund_disputes'
            ]);

            $dispute = new RefundDispute();
            $dispute->fill($request->all());
            if ($dispute->save()) {
                $result['status'] = true;
                $result['message'] = "Action was successful";
            } else {
                $result['status'] = false;
                $result['message'] = "Action was not carried out due to an error";
                $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
            }
        } catch (ValidationException $exception) {
            $result['status'] = false;
            $result['message'] = $exception->errors();
            $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
        }

        return response()->json($result, $statusCode);
    }
}