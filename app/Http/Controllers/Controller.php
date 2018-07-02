<?php

namespace App\Http\Controllers;

use App\Constants\Constant;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Model\Pincode;
use Illuminate\Support\Facades\Input;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function getAddress($pincode)
    {
        $model = new Pincode;
        return response()->json($model->getAdd($pincode));
    }
    public function getPincode(Request $Request)
    {
        //$Request = Input::get();
        //$district = Input::get(Constant::DISTRICT);
        //$state = Input::get(Constant::STATE);
        $model = new Pincode;
        return response()->json($model->getPin( $Request));
    }
}
