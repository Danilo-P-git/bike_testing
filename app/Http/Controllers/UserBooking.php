<?php

namespace App\Http\Controllers;
use App\Models\Bike;
use App\Models\Contract;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserBooking extends Controller
{
    public function select()
    {
        $category = Category::with('bike')->get();
        $today = Carbon::now()->format('Y-m-d');

        return view('booking.request', compact('category','today'));
    }
}
