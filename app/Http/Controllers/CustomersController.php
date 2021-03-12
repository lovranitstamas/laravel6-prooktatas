<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomersController extends Controller
{

    //4.óra
    public function indexByFilter()
    {

        $customers = Customer::all();

        return view('frontend.customers.indexByFilter')->with('customers', $customers);
    }

    //4.óra
    public function indexByFilterDateResult()
    {

        $customers = Customer::freshRegister()->get();

        return view('frontend.customers.indexByFilter')->with('customers', $customers);
    }


    public function indexByFilterSearch(Request $request)
    {

        $search = $request->input('search');
        $customers = Customer::search($search)->get();

        return view('frontend.customers.indexByFilter')->with('customers', $customers);

    }

    public function index(Request $request)
    {

        $search = $request->input('search');
        $search['orderBy'] = $request->input('orderBy');
        $search['orderDir'] = $request->input('orderDir');

        //$customers = Customer::all();
        $customers = Customer::search($search)->get();

        return view('frontend.customers.index')
            ->with('customers', $customers);

    }

    public function create()
    {
        $customer = new Customer();

        return view('frontend.customers.create')->with('customer', $customer);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'description' => 'required',
            'password' => 'required|confirmed',
            'terms' => 'accepted'
        ]);

        $customer = new Customer();
        /*$customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->description = $request->input('description');
        $customer->password = \Hash::make($request->input('password'));*/

        $customer->setAttributes($request->all());
        $customer->save();


        session()->flash('message', 'Köszönjük a regisztrációt');

        return redirect()->back();
    }


    public function show($customerId)
    {

        $customer = Customer::find($customerId);
        //$customer = Customer::where('id', $customerId)->first(); null a return , ha nincs

        return view('frontend.customers.show')->with('customer', $customer);
    }

    public function edit($customerId)
    {
        $customer = Customer::findOrFail($customerId);

        return view('frontend.customers.edit')->with('customer', $customer);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' . $request->id,
            'description' => 'required',
            'password' => 'confirmed'
        ]);

        $customer = Customer::findOrFail($id);
        /*$customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->description = $request->input('description');
        $customer->password = \Hash::make($request->input('password'));*/

        $customer->setAttributes($request->all());

        $customer->save();

        session()->flash('message', 'Köszönjük a módosítást');

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {

        $customer = Customer::find($id);
        $customer->delete();

        session()->flash('message', 'Törlés megtörtént');

        return redirect()->back();
    }

    public function destroyWithJson($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->delete();

        return response()->json(['message' => 'Az ügyfél törölve']);
        //return redirect()->route('customers.index');
    }


    public function convertToSql()
    {
        $tagId = 2;
        dd(Customer::whereHas('notes', function ($query) use ($tagId) {
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('id', $tagId);
            });
        })->toSql());

        //select * from `customers`
        // where exists
        // (select * from `notes` where `customers`.`id` = `notes`.`user_id`
        // and exists
        // (select * from `tags` inner join `note_tag` on
        // `tags`.`id` = `note_tag`.`tag_id` where `notes`.`id` = `note_tag`.`note_id` and `id` = ?))
    }

    public function testQueries()
    {

        Customer::where('name', 'LIKE', '%Horvath%')
            ->orWhere('email', 'LIKE', '%Horvath%') //orWhere, elég ha egy feltétel teljesül
            ->orderBy('name', 'asc')
            ->skip(5) //1-5 kihagyja
            ->limit(10) // 10et ad vissza
            ->get();  //Collectionként adja vissza
        //->count(); Hány darab van

        //utolsó elem:
        Customer::orderBy('id', 'desc')->first();

        //10nél több az idja ÉS horvathnak hívják  VAGY 02-15.én regisztrált
        Customer::where(function ($query) {
            $query->where('id', '>', 10)->where('name', 'LIKE', 'Horvath');
        })->orWhere('created_at', '=', '2021-02-15')
            ->get();

        Customer::whereBetween('created_at', ['2021-02-05', '2021-02-12']);

    }

    /*
    public function create()
    {
        return view('frontend.customers.create');
        $customer = new Customer();

        return view('frontend.customers.create')->with('customer', $customer);
    }

    public function store(Request $request)
    {

        $customer = new Customer;
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->password = \Hash::make($request->input('password'));
        $customer->setAttributes($request->all());
        $customer->save();

        session()->flash('message', 'Köszöjük a regisztrációt');
        return redirect()->back();
    }

    public function edit($customerId)
    {
        $customer = Customer::findOrFail($customerId);

        return view('frontend.customers.edit')->with('customer', $customer);
    }

    public function update(Request $request, $customerId)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' . $customerId,  //unique kivéve a megadott IDra
            'password' => 'confirmed'   //nem kötelező, de ha meg van adva, a 2jelszónak egyeznie kell
        ]);

        $customer = Customer::findOrFail($customerId);
        $customer->setAttributes($request->all());

        $customer->save();

        session()->flash('message', 'Az adatok módosultak');

        return redirect()->route('customers.index');
    }

    public function destroy($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->delete();

        return response()->json(['message' => 'Az ügyfél törölve']);
        //return redirect()->route('customers.index');
    }*/


    /*
    * 3.óra
    public function index()
    {
        $customers = Customer::all();

        return view('frontend.customers.index')->with('customers', $customers);
    }

    public function show($customerId)
    {
        $customer = Customer::find($customerId);
        //$customer = Customer::where('id', $customerId)->first();

        return view('frontend.customers.show')->with('customer', $customer);
    }

    public function create()
    {
        return view('frontend.customers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|confirmed',
            'terms' => 'accepted'
        ]);

        $customer = new Customer;
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->password = \Hash::make($request->input('password'));
        $customer->save();

        session()->flash('message', 'Köszöjük a regisztrációt');
        return redirect()->back();
    }


    public function index2()
    {

        $customer = Customer::orderBy('id', 'desc')->first();
        $customer = Customer::find(1);
        $customer->lastUpdated();

        dd($customer->lastUpdated());
        dd($customer->email);

        $customer = Customer::first();
        dd($customer);

        $customers = Customer::all();
        dd($customers);
    }

    public function newCustomer()
    {
        $customer = new Customer();
        $customer->name = 'Elek';
        $customer->description = 'beled2';
        $customer->email = 'elek2@elek.hu';
        $customer->password = \Hash::make('123456');
        $customer->save();
    }*/
}
