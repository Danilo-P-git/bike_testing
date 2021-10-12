<?php

namespace App\Http\Controllers;
use App\Models\Accessory;
use Illuminate\Http\Request;
use Illuminate\View\ViewServiceProvider;

use function GuzzleHttp\Promise\all;

class AccessoryController extends Controller
{
    public function index(){
        $accessori=Accessory::all();
        return view('accessory.accessory', compact('accessori'));
    }

    public function create(Request $req){
        $accessory = Accessory::all();
        return view('accessory.createaccessory', compact('accessory'));
    }

    public function store(Request $request){
        
        $accessori= Accessory::create([
            'nome'=>$request->nomeAccessorio,
            'quantita'=>$request->quantitaAccessorio,
        ]);
        

        return redirect()->back()->with('message', 'Accessorio inserito correttamente');


    }
}
