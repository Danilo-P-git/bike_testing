<?php

namespace App\Http\Controllers;
use App\Models\Bike;
use App\Models\Contract;
use App\Models\Category;
use Carbon\Carbon;

use Illuminate\Http\Request;

class BikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        
        $bikes = Bike::all();

        // guarda l'observer 
        // dd($contracts);
        return view('bike.bikeIndex', compact('bikes', 'today'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('bike.bikeCreate', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newBike = new Bike;
        $newBike->name = $request->name;
        $newBike->valore_noleggio = $request->valore_noleggio;
        $newBike->valore_acquisto = $request->valore_acquisto;
        $newBike->valore_vendita = $request->valore_vendita;
        $newBike->manutenzione = 0;
        $newBike->category_id = $request->category_id;
        $newBike->save();   
        return redirect()->route('bikeIndex', $newBike);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $bikes = Bike::findOrFail($id);
        $categories = Category::all();

        return view('bike.bikeEdit', compact('categories', 'bikes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bike = Bike::find($id);
        $bike->name = $request->name;
        $bike->valore_noleggio = $request->valore_noleggio;
        $bike->valore_acquisto = $request->valore_acquisto;
        $bike->valore_vendita = $request->valore_vendita;
        $bike->category_id = $request->category_id;
        $bike->push();
        return redirect()->route('bikeIndex', $bike);
    }

    public function manutenzione(Request $request, $id)
    {   
        if ($request->manutenzione == 'on') {
            $manutenzione = 1;
        } else {
            $manutenzione = 0;
        }
        $bike = Bike::find($id);
        $bike->manutenzione = $manutenzione;
        $bike->push();

        return redirect()->route('bikeIndex', $bike);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bike = Bike::findOrFail($id);
        $bike->delete();
        return redirect()->route('bikeIndex', $bike);

    }
}
