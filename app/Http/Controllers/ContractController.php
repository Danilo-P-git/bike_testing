 <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use App\Models\Contract;
use App\Models\Category;
use App\Models\Photo;
use Carbon\Carbon;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Support\Facades\Storage;


class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');

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
        $today = Carbon::now()->format('Y-m-d');

        // $bikes = Bike::where([
        //     ['manutenzione', '=', 0],
        //     ['bloccata', '=', 0],
        //     ])->get();
        return view('contract.contractCreate', compact('today'));
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






    public function bikeChosing($id)
    {
        $today = Carbon::now()->format('Y-m-d');

        $contract = Contract::with('bike')->find($id);
        // dd($contract->data_inizio);
        $bikes = Bike::with('category')->where([
            ['manutenzione', '=', 0],
            ])->get();
        // dd($contract);
        $biciCorretta = array();
        $biciSbagliata= array();
        foreach ($bikes as $bike) {
            if (count($bike->contract) > 0) {
                foreach ($bike->contract as $contrattoEsistente) {

                    if ($contract->data_inizio <= $contrattoEsistente->data_fine) {
                        $errore = "Bici non disponibile per quelle date";

                    }   else {
                        array_push($biciCorretta, $bike);



                    }
                }


            } else {
                array_push($biciCorretta, $bike);

            }
        }

        // dd($contract);
        $availables = array_unique($biciCorretta);
        // dd($biciCorretteCollection);


        return view('contract.contractBikeChosing', compact('availables','contract'));
    }

    public function bikeStoring(Request $request, $id){


        $contract = Contract::with('bike')->find($id);

        $contract->bike()->sync($request->bike);
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



        $image_parts = explode(";base64,", $request->signed);



        $image_type_aux = explode("image/", $image_parts[0]);



        $image_type = $image_type_aux[1];

        $fileName = 'sign'.$contract->id.".png";

        $image_base64 = base64_decode($image_parts[1]);


        $path = Storage::disk('public')->put($fileName, $image_base64);

        $contract = Contract::find($id);
        $contract->sign = '/storage/'.$fileName;
        $contract->push();
        return back()->with('success', 'success Full upload signature');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $contract = Contract::with('bike')->find($id);

        return view('contract.contractShow', compact('contract'));
    }

    public function generaPdf($id)
    {
        $today = Carbon::now()->format('Y-m-d');

        $contract = Contract::with('bike')->find($id);
        view()->share('contract', $contract);
        $pdf = PDF::loadView('templatePdf.contractPdf', $contract);

        return $pdf->download('contratto.pdf');
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
