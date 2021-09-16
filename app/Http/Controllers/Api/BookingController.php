<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bike;
use App\Models\Contract;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\Photo;


class BookingController extends Controller
{
    public function changePrice(){
        $days = $_GET['numberDay'];

        /* $dataStart=$_GET['dataStart'];
        $dataEnd=$_GET['dataEnd']; */



        return response()->json($days);
    }
}
