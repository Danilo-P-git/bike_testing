<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use App\Models\Contract;
use App\Models\Category;
use App\Models\Photo;
use Carbon\Carbon;


class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::today();

        $contracts = Contract::with('bike', 'photo')->orderBy('id')->get();
        // dd($contracts);
        return view('contract.contractIndex', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bikes = Bike::where([
            ['manutenzione', '=', 0],
            ['bloccata', '=', 0],
            ])->get();
        return view('contract.contractCreate', compact('bikes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // dd($request->bike);
        $newContract = new Contract;
        $newContract->nome = $request->nome;
        $newContract->cognome = $request->cognome;
        $newContract->data_inizio = $request->data_inizio;
        $newContract->data_fine = $request->data_fine;
        $newContract->tel = $request->tel;
        $newContract->mail = $request->mail;
        $newContract->nato_a = $request->nato_a;
        $newContract->nato_il = $request->nato_il;
        $newContract->comune_residenza = $request->comune_residenza;
        $newContract->n_documento = $request->n_documento;
        $newContract->data_documento = $request->data_documento;
        $newContract->ente_documento = $request->ente_documento;
        $newContract->via_residenza = $request->via_residenza;
        $newContract->residenza_temp = $request->residenza_temp;

        $newContract->save();
        
        $newId = $newContract->id;
        $contract = Contract::with('bike')->find($newId);

        $contract->bike()->sync($request->bike);

        return redirect()->route('contractShow', $newContract)


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
