<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Models\PaymentBrands;
use App\Traits\GeneralFunction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use GeneralFunction;
    public function __construct()
    {
        $this->changeLang(request()->header('lang-app'));

    }
    public function index()
    {
        try {
            $data = PaymentBrands::query()->where('is_deleted',0)->get();
            return $this->sendSuccessResponse($data);

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }
}
