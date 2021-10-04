<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Bike;
use App\Models\Category;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserBooking extends Controller
{
    public function select()
    {
        $category = Category::with('bike')->get();
        
        $today = Carbon::now()->format('Y-m-d');
        
        $categoryId=DB::table('categories')->select('id')->orderBy('id', 'asc')->get();
        
        
        
        
        foreach ($categoryId as $key) {
            
            //assegno alla chiave l'id della categoria in modo da poter richiamare il dato nella vista, in questo modo avrò un array chiave=>valore dove la chiave è l'id della categoria e il valore è il conteggio delle bici trovate in quella categoria 
            $quantity[$key->id]=DB::table('bikes')->where('category_id','=',$key->id)->count('*');
        }
        /* dd($categoryId); */
        
        
        
        return view('booking.request', compact('category','today','quantity'));
    }

    public function available(Request $request)
    {
        
        $data = $request->all();
        
        $newData = array();
        
        $categoryArr = array();
        
        // manipolo la request per pulirla e salvarmi un altro array da utilizzare dopo
        
        foreach ($data as $key => $value) {
        /* dd($value); */
            
            if ($value == 0) {
                
            } else {
                
                $newData[$key] = $value;
                /* dd($newData); */
                
            }
            
        }
        /* dd($newData); */
    

        // ciclo la request e verifico con il nuovo array le categorie e creo un nuovo array con $key == id categoria && $value == quantita ordianata 
        foreach ($data as $key => $value) {
            
            foreach ($newData['category'] as $key2 => $value2) {
                
                if ($value2 == $key ) {
                    
                    $categoryArr[$value2] = $value;
                    
                }
            }

        }  


        

        // Gestione date
        $dataRange = $newData['range_date'];

        // 

        $arraySplit = explode(' - ', $dataRange);

        $formatCarbonStart = Carbon::createFromFormat('d/m/Y', $arraySplit[0])->format('d-m-Y');

        $formatCarbonEnd = Carbon::createFromFormat('d/m/Y', $arraySplit[1])->format('d-m-Y');

        $inputStartDate = Carbon::parse($formatCarbonStart)->format('Y-m-d');
        $inputEndDate = Carbon::parse($formatCarbonEnd)->format('Y-m-d');

        $bookingStart = Carbon::createFromFormat('Y-m-d',$inputStartDate);
        $bookingEnd = Carbon::createFromFormat('Y-m-d',$inputEndDate);

        // 
        // Gestione date

        // Dichiaro i due array delle bici 
        $biciCorretta = array();
        $biciSbagliata= array();
        
        // Ciclo l'array delle categorie 
        foreach ($categoryArr as $key => $value) {
            
            for ($i=0; $i <count($categoryArr) ; $i++) { 
                $category[$i] = Category::find($key);
                
            
            /* dd($category); */
            
        
            // Per ogni iterazione faccio una query e limito le risposte di questa query in base alla quantità che mi hanno mandato
            $bikes = Bike::with('category')->where([
                ['manutenzione', '=', 0],
                ['category_id', '=', $key],
                ])->get();
              
                /* dd($bikes); */
            // 
            if (count($bikes) < $value) {
                return back()->with('message', 'Quantità maggiore delle bici disponibili '.$category[$i]->tipo);
            } else {
                // ciclo le bici trovate
                foreach ($bikes as $bike) {
                    
                    // se hanno dei contratti 
                    if (count($bike->contract) > 0) {
                        // 
                        // ciclo i loro contratti
                        foreach ($bike->contract as $contrattoEsistente) {
                            /* dd($contrattoEsistente); */
                            // faccio una validazione dove vedo se le date immesse dal cliente hanno bici disponibili
                            $contrattoEsistenteStart = Carbon::createFromFormat('Y-m-d',$contrattoEsistente->data_inizio);

                            $contrattoEsistenteEnd = Carbon::createFromFormat('Y-m-d',$contrattoEsistente->data_fine);

                            
                            $check1 = $bookingStart->lte($contrattoEsistenteEnd);
                            $check2 = $bookingEnd->gte($contrattoEsistenteStart);
                            
                            /* dd($contrattoEsistente->pivot->bike_id); */
                            

                            if ($check1 && $check2) {

                                return back()->with('message', 'Bici '.$bike->Category->tipo.' non disponibili in quelle date');

                            }   else {
                                array_push($biciCorretta, $bike);
                                
                                
        
                                
        
                            }
                        }
                    } else {
                        array_push($biciCorretta, $bike);
                        
                        

                    }
                }
            }
        }
        }
        // dd($biciCorretta);
        // dichiaro l'array delle bici che selezionerò
        $biciSelezionata = array();
        // dd($categoryArr);
        // ciclo di nuovo l'array delle categorie 
        foreach ($categoryArr as $key => $value) {
            /* dd($categoryArr); */
            
            // dichiaro un contatore per la quantita di bici che debbo trovare 
            $cont = 1;
            
            
            foreach ($biciCorretta as $chiave => $valore) {
                // incremento il contatore di base da 0 a 1 
                // $cont ++ ;

                
                $biciSingola = $valore;
      
                // se la categoria della bici singola è corretta e la quantita ($value) è inferiore o uguale al contatore 
                // pusho la bici nell'array

                if ($biciSingola->category_id == $key && $cont <= $value) {
                    $cont ++;
                    array_push($biciSelezionata, $biciSingola);

                    

                } 
            }
            
        }

        /* dd($biciSelezionata); */

        // Gestione Costi

        $diffDays = $bookingEnd->diffInDays($bookingStart);

        $price = 0;

        foreach ($biciSelezionata as $key) {
            
        //    
            if ($diffDays <= 1) {
                $price += $key->category->base;
        
                
            } elseif ($diffDays == 2) {
                $price += $key->category->twoDay;
        
                
            } elseif ($diffDays == 3) {
                $price += $key->category->threeDay;
        

            } elseif ($diffDays == 4) {
                $price += $key->category->fourDay;
        

            } elseif ($diffDays == 5) {
                $price += $key->category->fiveDay;
        

            } elseif ($diffDays == 6) {
                $price += $key->category->sixDay;
        

            } elseif ($diffDays == 7) {
                $price += $key->category->sevenDay;
        

            } elseif($diffDays > 7) {
                $overpriceDiff = $diffDays - 7;
                $sette = $key->category->sevenDay;
                $surplus = $key->category->overprice * $overpriceDiff;
                $price += $sette + $surplus;
                

            }
        }
        

        $nome = $request->name;
        $cognome = $request->cognome;
        $mail = $request->mail;
        $telefono = $request->tel;
        

        $contract = new Contract;
        $contract->nome = $nome;
        $contract->cognome = $cognome;
        $contract->data_inizio = $inputStartDate;
        $contract->data_fine = $inputEndDate;
        $contract->tel = $telefono;
        $contract->mail = $mail;
        $contract->temporanei = 1;
        $contract->online = 1;
        $contract->costo = $price;
        $contract->save();
        foreach ($biciSelezionata as $biciDaAttaccare) {
            
            $contract->bike()->attach($biciDaAttaccare->id);
            
        }
        $contract->load('bike');
        
        // dd($contract);


        return view('booking.confirm', compact('contract') );
    }

    public function deleteContract(Request $request){
        
        $category = Category::with('bike')->get();
        $today = Carbon::now()->format('Y-m-d');
        $idContract=$request->annulla;
        $quantity=0;

        $contract=DB::table('contracts')->where('id','=', $idContract)->delete();

        return redirect()->route('bookingSelect')->with('message', 'Prenotazione annullata');

    }




    public function donePay(){


        $CHIAVESEGRETA = 'DC0TYLAMY69IOFXKCR7LPFBY4L6DYKCU';
        $requiredParams = array('codTrans', 'esito', 'importo', 'divisa', 'data', 'orario', 'codAut', 'mac');
            foreach ($requiredParams as $param) {
                
                if (!isset($_REQUEST[$param])) {
                echo 'Paramentro mancante ' . $param;
                $updateEsito=DB::table('contracts')->where('id','=',$_REQUEST['codTrans'])->update(['esito' => $_REQUEST['esito']]);
                exit;
                }
            }
        $macCalculated = sha1('codTrans=' . $_REQUEST['codTrans'] .
        'esito=' . $_REQUEST['esito'] .
        'importo=' . $_REQUEST['importo'] .
        'divisa=' . $_REQUEST['divisa'] .
        'data=' . $_REQUEST['data'] .
        'orario=' . $_REQUEST['orario'] .
        'codAut=' . $_REQUEST['codAut'] .
        $CHIAVESEGRETA
        );

        if ($macCalculated != $_REQUEST['mac']) {
            echo 'Errore MAC: ' . $macCalculated . ' non corrisponde a ' . $_REQUEST['mac'];
            exit;
        }
        $esito=$_REQUEST['esito'];
        $codiceTrans=$_REQUEST['codTrans'];
        $codAut=$_REQUEST['codAut'];
        $message=$_REQUEST['messaggio'];
        

        $updateEsito=DB::table('contracts')->where('id','=',$_REQUEST['codTrans'])->update(['esito' => $_REQUEST['esito']]);
        $contratto=DB::table('bike_contract')->where('contract_id', '=', $codiceTrans)->get();
        
        foreach ($contratto as $key) {

            for ($i=0; $i <count($contratto) ; $i++) { 
                //reperisco dal DB i dettagli del contratto
                $dettagliContract=$contratto[$i]->contract_id;
                $dettagliContratto[$i]=DB::table('contracts')->where('id','=', $dettagliContract)->get();
                //reperisco dal BD i dettagli delle bici
                $idBikes=$contratto[$i]->bike_id;
                $contract[$i]=DB::table('bikes')->where('id','=', $idBikes)->select('name','taglia','category_id')->get();
            }


        }
        return view('booking.done', compact('esito','codiceTrans','codAut','message','contratto','dettagliContratto','contract'));
    }


    public function checkBike(Request $request){
        $date1=Carbon::parse($request->start)->format('Y-m-d');
        $date2=Carbon::parse($request->end)->format('Y-m-d');
        

        $contract=DB::table('contracts')->get();
        $contractdate=DB::table('contracts')->whereRaw('? between data_inizio and data_fine', [$date1,$date2])->get();
        
        if (count($contractdate) > 0) {

            foreach ($contractdate as $key) {
                
                $bikeContract=DB::table('bike_contract')
                ->join('contracts','contracts.id','bike_contract.contract_id')
                ->join('bikes','bikes.id','=','bike_contract.bike_id')
                ->get();
            
            $bikes=Bike::all();
            for ($i=0; $i <count($bikeContract) ; $i++) { 
                $idbike[$i]=$bikeContract[$i]->bike_id;
            }

            $findbike=$bikes->except($idbike)->groupBy('category_id')->toArray();
            
            
            

            
            
        }
            /* foreach ($bikeContract as $key) {
                $bikeselect=DB::table('bikes')->where('id','=',$key->bike_id)->get();
                
            }
    
            foreach ($bikeselect as $key) {
                $idcat=$key->category_id;
                $quantity=DB::table('bikes')->select('category_id')->whereNotIn('category_id',[$idcat])->get();
            }
            foreach ($quantity as $key) {
                $qty[$key->category_id]=DB::table('bikes')->where('category_id','=',$key->category_id)->count('*');
            } */
            return response()->json(["qty"=>$findbike]);
        } else {
            $categoryId=DB::table('categories')->select('id')->orderBy('id', 'asc')->get();
                foreach ($categoryId as $key) {
            
                    //assegno alla chiave l'id della categoria in modo da poter richiamare il dato nella vista, in questo modo avrò un array chiave=>valore dove la chiave è l'id della categoria e il valore è il conteggio delle bici trovate in quella categoria 
                    $quantity[$key->id]=DB::table('bikes')->where('category_id','=',$key->id)->count('*');
                }
                /* return view('bookingSelect', compact('quantity')); */
        return response()->json(["qty"=>$quantity]);
        }
    }
}
