<?php

namespace App\Http\Controllers;
use App\Models\Bike;
use App\Models\Contract;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\Photo;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        

        if ($request->has('data')) {
            $today = $request->data;
            // $difference = 1;

        } else {
            $today = Carbon::now()->format('Y-m-d');
        }

        $categories = Category::all();
        $bikes = Bike::all();
        foreach ($bikes as $bike) {
            if (count($bike->contract)>0) {
                foreach ($bike->contract as $contract) {
                    $end_date = $contract->data_fine;
                    $start_date = $contract->data_inizio;
                    if ($today>=$start_date && $today<=$end_date) {
                        $bike->setRelation('temp', 1);
                        // dd($bike);

                    } else {
                        $bike->setRelation('temp', 0);

                    }
                }
            }
        }
        return view('bike.bikeIndex', compact('bikes', 'categories', 'today'));

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
        $request->validate([
            'name' => "required|max:191",
            // 'valore_noleggio' => "required|min:0",
            'valore_acquisto' => "required|min:0",
            'valore_vendita' => "required|min:0",
        ],
        [
            'nome.required'=> 'Inserisci il modello della bici',
            'nome.max'=> 'Nome modello troppo lungo',
            // 'valore_noleggio.required'=>'Inserire un prezzo di noleggio',
            // 'valore_noleggio.min'=>'Inserire un prezzo di noleggio',
            'valore_acquisto.required'=>'Inserire il valore a cui è stata acquistata la Bike',
            'valore_acquisto.min'=>'Inserire un valore maggiore di zero',
            'valore_vendita.required'=>'Inserire un valore',
            'valore_vendita.min'=>'Inserire un valore Positivo'
        ]
        );


        $newBike = new Bike;
        $newBike->name = $request->name;
        $newBike->valore_acquisto = $request->valore_acquisto;
        $newBike->valore_vendita = $request->valore_vendita;
        $newBike->manutenzione = 0;
        $newBike->category_id = $request->category_id;

        $newBike->save();
        $newId = $newBike->id;
        $cover_photo = $request->cover_photo->storeAs(
            "images/".$newId,
            "cover_image".$newId.".jpg",
            "public"
        );
        $newBike->cover_photo = $cover_photo;
        $newBike->push();

        if ($request->hasFile('photo')) {
            $images = $request->file('photo');
            foreach ($images as $key =>$image) {
                $path = $image->storeAs(
                    "images/".$newId,
                    "image".$key."-".$newId.".jpg",
                    "public"
                );
                $newPhoto = new Photo;
                $newPhoto->path = $path;
                $newPhoto->bike_id = $newId;
                $newPhoto->save();
            }
        }
        return redirect()->route('bikeIndex', $newBike);
    }


    public function category(Request $request)
    {
        $categories = Category::where('tipo', '=', $request->tipo)->get();
        // dd($categories->isEmpty());

        if ($categories->isEmpty()) {
            $category = new Category;
            $category->tipo = $request->tipo;
            if ($request->filled(['base', 'twoDay', 'threeDay', 'fourDay', 'fiveDay', 'sixDay', 'sevenDay', 'overprice'])) {
                $category->base = $request->base;
                $category->twoDay = $request->twoDay;
                $category->threeDay = $request->threeDay;
                $category->fourDay = $request->fourDay;
                $category->fiveDay = $request->fiveDay;
                $category->sixDay = $request->sixDay;
                $category->sevenDay = $request->sevenDay;
                $category->overprice = $request->overprice;
                $cover_image = $request->cover_image->storeAs(
                    "images/".$category->tipo,
                    "image-cat-".$category->tipo.".jpg",
                    "public"
                );
                $category->cover_image = $cover_image;

            }

            $category->save();

            return back()->with('message', 'Categoria aggiunta');

        } else {
            return back()->with('message', 'Categoria già presente');
        }


    }
    public function editCategory(Request $request, $id)
    {
        $category = Category::find($id);
        $category->tipo = $request->tipo;
        $category->base = $request->base;
        $category->twoDay = $request->twoDay;
        $category->threeDay = $request->threeDay;
        $category->fourDay = $request->fourDay;
        $category->fiveDay = $request->fiveDay;
        $category->sixDay = $request->sixDay;
        $category->sevenDay = $request->sevenDay;
        $category->overprice = $request->overprice;

        // validazione image presente.

        if (!is_null($request->cover_image)) {
            $cover_image = $request->cover_image->storeAs(
                "images/".$category->tipo,
                "image-cat-".$category->tipo.".jpg",
                "public"
            );
        $category->cover_image = $cover_image;

        }


        $category->push();
        return back()->with('message', 'Categoria modificata');
    }

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

        $request->validate([
            'name' => "required|max:191",
            // 'valore_noleggio' => "required|min:0",
            'valore_acquisto' => "required|min:0",
            'valore_vendita' => "required|min:0",
        ],
        [
            'nome.required'=> 'Inserisci il modello della bici',
            'nome.max'=> 'Nome modello troppo lungo',
            // 'valore_noleggio.required'=>'Inserire un prezzo di noleggio',
            // 'valore_noleggio.min'=>'Inserire un prezzo di noleggio',
            'valore_acquisto.required'=>'Inserire il valore a cui è stata acquistata la Bike',
            'valore_acquisto.min'=>'Inserire un valore maggiore di zero',
            'valore_vendita.required'=>'Inserire un valore',
            'valore_vendita.min'=>'Inserire un valore Positivo'
        ]
        );

        $bike = Bike::find($id);
        $bike->name = $request->name;
        // $bike->valore_noleggio = $request->valore_noleggio;
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
