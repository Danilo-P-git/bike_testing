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

    public function available(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        $newData = array();
        foreach ($data as $key => $value) {
            if ($value == 1) {
                
            } else {
                $newData[$key] = $value;
            }

        }
        // dd($newData['category']);
        // Gestione date
        $dataRange = $newData['range_date'];
        dd($dataRange);
        $arraySplit = explode(' - ', $dataRange);
        $formatCarbonStart = Carbon::createFromFormat('d/m/Y', $arraySplit[0])->format('d-m-Y');
        $formatCarbonEnd = Carbon::createFromFormat('d/m/Y', $arraySplit[1])->format('d-m-Y');

        $inputStartDate = Carbon::parse($formatCarbonStart)->format('Y/m/d');
        $inputEndDate = Carbon::parse($formatCarbonEnd)->format('Y/m/d');
    
        // Gestione date

         foreach ($newData['category'] as $key => $value) {
            $bikes = Bike::with('category')->where([
                ['manutenzione', '=', 0],
                ['category_id', '=', $value],
            ])->get();
         }
         dd($bikes); 

        
        // $bikes = Bike::with('categories')->where('category_id')
    }
}
