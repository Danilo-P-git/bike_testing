<?php
namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Bike;
use App\Models\Photo;
use App\Models\Category;
use App\Models\Contract;
use App\Mail\SendNewMail;
use App\Models\Accessory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
// set_time_limit(300);
class ContractController extends Controller
{
    

    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');

        $contracts = Contract::with('bike')->orderBy('id', 'desc')->get();
        // dd($contracts);
        return view('contract.contractIndex', compact('contracts'));
    }


    public function create()
    {
        $today = Carbon::now()->format('Y-m-d');

        // $bikes = Bike::where([
        //     ['manutenzione', '=', 0],
        //     ['bloccata', '=', 0],
        //     ])->get();
        return view('contract.contractCreate', compact('today'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nome' => "required|max:191",
            'cognome' => "required|max:191",
            'data_inizio'=>"required|date",
            'data_fine'=>"required|date",
            'tel'=>"required_without:mail",
            'mail'=>"required_without:tel",
            'nato_a'=>"max:191",
            'nato_il'=>"date",
            'comune_residenza'=>"max:191",
            'n_documento'=>"",
            'ente_documento'=>"max:191",
            'data_documento'=>"date",
            'via_residenza'=>"max:191",
            'residenza_temp'=>"max:191",
        ]);
        

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

        
        // $newId = $newContract->id;
        // $contract = Contract::with('bike')->find($newId);

        // $contract->bike()->sync($request->bike);

        return redirect()->route('contractBikeChosing', $newContract);


    }



    public function sendMail($id){
        
        $contract = Contract::find($id);


        Mail::to($contract->mail)->send(new SendNewMail($contract));
        return back()->with(['message', 'Email Mandata']);
    }

    public function sendSms($id){
        $contract = Contract::find($id);

        $basic  = new \Nexmo\Client\Credentials\Basic('f4a4f7d7', 'sH4HY84R9xkY3gJH');
        $client = new \Nexmo\Client($basic);
 
        $message = $client->message()->send([
            'to' => $contract->tel,
            'from' => 'Etnatribe',
            'text' => 'Clicca il seguente link per confermare http://127.0.0.1:8000/contract/signature'.$contract->id
        ]);
 
        // dd('SMS message has been delivered.');
        
        
        return back()->with(['message', 'Sms inviato']);
    }




    public function bikeChosing($id)
    {
        // $today = Carbon::now()->format('Y-m-d');
        $accessori=Accessory::all();
        
        $contract = Contract::with('bike')->find($id);
        // dd($contract->data_inizio);
        $bikes = Bike::with('category')->where([
            ['manutenzione', '=', 0],
            ])->get();
        // dd($contract);
        // dd($bikes);
        // dd(gettype($contract->data_inizio));

        $biciCorretta = array();
        $biciSbagliata= array();
        foreach ($bikes as $bike) {
            if (count($bike->contract) > 0) {
                foreach ($bike->contract as $contrattoEsistente) {


                    $contrattoCreatoInizio = $contract->data_inizio;

                    $carbonStart = Carbon::createFromFormat('Y-m-d',$contrattoCreatoInizio);

                    $contrattoCreatoFine =  $contract->data_fine;

                    $carbonEnd = Carbon::createFromFormat('Y-m-d',$contrattoCreatoFine);
                    
                    $contrattoEsistenteStart = Carbon::createFromFormat('Y-m-d',$contrattoEsistente->data_inizio);

                    $contrattoEsistenteEnd= Carbon::createFromFormat('Y-m-d',$contrattoEsistente->data_fine);

                    // $check1 = $contrattoEsistenteStart->between($carbonStart,$carbonEnd);

                    // $check2 = $contrattoEsistenteEnd->between($carbonStart,$carbonEnd);

                    $check1 = $carbonStart->lte($contrattoEsistenteEnd);
                    $check2 = $carbonEnd->gte($contrattoEsistenteStart);

                    if ($check1 && $check2) {
                        // dd('giusto');
                        $errore = "Bici non disponibile per quelle date";
                        array_push($biciSbagliata, $bike);
                    }   else {
                        array_push($biciCorretta, $bike);



                    }
                }


            } else {
                array_push($biciCorretta, $bike);

            }
        }

        // dd($biciSbagliata);
        $availables = array_unique($biciCorretta);
        // dd($biciCorretteCollection);


        return view('contract.contractBikeChosing', compact('availables','contract','accessori'));
    }

    public function bikeStoring(Request $request, $id){

        //dd($id);
        
        $accessory= Contract::with('accessori')->find($id);
        //dd($accessory);
        $contract = Contract::with('bike.category')->find($id);
       // dd($contract);
        
        $accessori=$request->accessorio;


        if ($request->bike==0) {
            
        }else {
            
            foreach ($request->bike as $bike) {
                $contract->bike()->attach($bike);
                //dd($contract);
            }
        }
        if ($accessori==0) {
            
        }else {
            foreach ($accessori as $accessorio) {
                // dd($accessorio);
                 $accessory->accessori()->attach($accessorio);
                 //dd($accessory);
             }
        }
        

        
        $contract->load('bike');
       
        // dd($contract);

        $contract->save();
        $startDate = $contract->data_inizio;
        $endDate = $contract->data_fine;
        $carbonStart = Carbon::parse($startDate);
        $carbonEnd = Carbon::parse($endDate);
        $differenza = $carbonEnd->diffInDays($carbonStart);
        $price = 0;
        // dd($contract->bike);

        foreach ($contract->bike as $key) {
            // dd($key);
            if ($differenza <= 1) {
                $price += $key->category->base;
        
                
            } elseif ($differenza == 2) {
                $price += $key->category->twoDay;
        
                
            } elseif ($differenza == 3) {
                $price += $key->category->threeDay;
        

            } elseif ($differenza == 4) {
                $price += $key->category->fourDay;
        

            } elseif ($differenza == 5) {
                $price += $key->category->fiveDay;
        

            } elseif ($differenza == 6) {
                $price += $key->category->sixDay;
        

            } elseif ($differenza == 7) {
                $price += $key->category->sevenDay;
        

            } elseif($differenza > 7) {
                $overpriceDiff = $differenza - 7;
                $sette = $key->category->sevenDay;
                $surplus = $key->category->overprice * $overpriceDiff;
                $price += $sette + $surplus;
                

            }

            
            $contract->costo = $price;
            $contract->push();

        }


        // dd($price);

       

        // dd($key);
        return redirect()->route('contractShow', $contract);
    }

    public function signature($id)
    {
        $contract = Contract::find($id);



        return view('contract.contractSignature', compact('contract'));

    }


    public function signatureUpload(Request $request ,$id)
    {
        $contract = Contract::find($id);

        // $folderPath = public_path()."storage/";
        $request->validate([
        'nome' => "required|max:191",
        'cognome' => "required|max:191",
        'data_inizio'=>"required|date",
        'data_fine'=>"required|date",
        'tel'=>"required",
        'mail'=>"required",
        'nato_a'=>"required|max:191",
        'nato_il'=>"required|date",
        'comune_residenza'=>"required|max:191",
        'n_documento'=>"required",
        'ente_documento'=>"required|max:191",
        'data_documento'=>"required|date",
        'via_residenza'=>"required|max:191",
        'residenza_temp'=>"required|max:191",
        ]);

        $contract->nome = $request->nome;
        $contract->cognome = $request->cognome;
        $contract->data_inizio = $request->data_inizio;
        $contract->data_fine = $request->data_fine;
        $contract->tel = $request->tel;
        $contract->mail = $request->mail;
        $contract->nato_a = $request->nato_a;
        $contract->nato_il = $request->nato_il;
        $contract->comune_residenza = $request->comune_residenza;
        $contract->n_documento = $request->n_documento;
        $contract->data_documento = $request->data_documento;
        $contract->ente_documento = $request->ente_documento;
        $contract->via_residenza = $request->via_residenza;
        $contract->residenza_temp = $request->residenza_temp;
        $contract->push();

        $image_parts = explode(";base64,", $request->signed);



        $image_type_aux = explode("image/", $image_parts[0]);



        $image_type = $image_type_aux[1];

        $fileName = 'sign'.$contract->id.".jpg";

        $image_base64 = base64_decode($image_parts[1]);


        $path = Storage::disk('public')->put($fileName, $image_base64);

        $contract = Contract::find($id);
        $contract->sign = '/storage/'.$fileName;
        $contract->push();

        $fileName = "contratto-".$contract->id.".pdf";
        $pdf = PDF::loadView('templatePdf.contractPdf', compact('contract') );
        Storage::put('public/contract/'.$fileName, $pdf->output());
        $contract->path = '/storage/contract/'.$fileName;
        
        $contract->push();
        return $pdf->download($fileName);;

    }
    
    public function show($id)
    {
        
        $accessory=Contract::with('accessori')->find($id);
        //dd($accessory);
        $contract = Contract::with('bike.photo')->find($id);

        return view('contract.contractShow', compact('contract','accessory'));
    }

    public function generaPdf($id)
    {
        $today = Carbon::now()->format('Y-m-d');

        $contract = Contract::with('bike')->find($id);
        // dd($contract);
        $fileName = "contratto-".$contract->id.".pdf";
        $pdf = PDF::loadView('templatePdf.contractPdf', compact('contract') );
        Storage::put('public/contract/'.$fileName, $pdf->output());
        $contract->path = '/storage/contract/'.$fileName;
        
        $contract->push();

        return $pdf->download($fileName);
    }

    public function generaemptyPdf()
    {
        $today = Carbon::now()->format('Y-m-d');
        
        
        // dd($contract);
        $fileName = "contratto-empty.pdf";
        $pdf = PDF::loadView('templatePdf.EmptycontractPdf');
        /* Storage::put('public/contract/'.$pdf->output()); */
        
        
        

        return $pdf->download($fileName);
    }

    public function edit($id){

        $contract=Contract::find($id);
        

        return view('contract.contractEdit',compact('contract'));
    }

    public function updateAccessory(Request $request, $id){

        //dd($request);
        $idAccessory=$request->accessory_id;
        $accessoryContract=Contract::with('accessori')->find($id);
        //dd($accessoryContract);
        foreach ($accessoryContract->accessori as $key) {
            $accessoryDel=DB::table('accessory_contract')->where('accessory_id','=', $idAccessory)->delete();
        }
        //dd($bikeDel);
        return redirect()->back();
    }
    public function updateBike(Request $request, $id){

        //dd($request);
        $idBike=$request->bike_id;
        $bikeContract=Contract::with('bike')->find($id);
        foreach ($bikeContract->bike as $key) {
            $bikeDel=DB::table('bike_contract')->where('bike_id','=', $idBike)->delete();
            $bikebloccataFalse=DB::table('bikes')->where('id','=', $idBike)->update(['bloccata'=>0]);

        }
        //dd($bikeDel);
        return redirect()->back();
    }

    public function delete($id){

        $contract=Contract::find($id)->delete();

        return redirect()->back();
    }
}
