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


        
        $data = $request->all();
        $newData = array();

        $categoryArr = array();

        // manipolo la request per pulirla e salvarmi un altro array da utilizzare dopo
        
        foreach ($data as $key => $value) {

            if ($value == 0) {
                
            } else {

                $newData[$key] = $value;

            }

        }
    

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


            $category = Category::find($key);


            // Per ogni iterazione faccio una query e limito le risposte di questa query in base alla quantità che mi hanno mandato
            $bikes = Bike::with('category')->where([
                ['manutenzione', '=', 0],
                ['category_id', '=', $key],
            ])->get();

            // 
            if (count($bikes) < $value) {
                return back()->with('message', 'Quantità maggiore delle bici disponibili '.$category->tipo);
            } else {
                // ciclo le bici trovate
                foreach ($bikes as $bike) {
                    // se hanno dei contratti 
                    if (count($bike->contract) > 0) {
                        // 
                        // ciclo i loro contratti
                        foreach ($bike->contract as $contrattoEsistente) {
                            // faccio una validazione dove vedo se le date immesse dal cliente hanno bici disponibili
                            $contrattoEsistenteStart = Carbon::createFromFormat('Y-m-d',$contrattoEsistente->data_inizio);

                            $contrattoEsistenteEnd = Carbon::createFromFormat('Y-m-d',$contrattoEsistente->data_fine);

                            $check1 = $bookingStart->lte($contrattoEsistenteEnd);
                            $check2 = $bookingEnd->gte($contrattoEsistenteStart);

                            if ($check1 && $check2) {

                                // return back()->with('message', 'Bici non disponibili in quelle date'.$bike->id);

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
        // dd($biciCorretta);
        // dichiaro l'array delle bici che selezionerò
        $biciSelezionata = array();
        // dd($categoryArr);
        // ciclo di nuovo l'array delle categorie 
        foreach ($categoryArr as $key => $value) {
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

        // dd($biciSelezionata);

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
}
