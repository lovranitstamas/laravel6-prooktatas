<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Note;

class PostController extends Controller
{

    //7. óra
    public function __construct()
    {
        $this->middleware('own_note')->only(['edit', 'update', 'destroy']);
    }

    //6.óra
    public function index($customerId = null)
    {

        //$note = new Note();
        //dd($note->tags()->toSql());
        //Pivot example
        //$ll = Note::find(11);
        //foreach ($ll->tags as $l){
        //echo $l->pivot->weight;
        //}

        $notes = Note::all();

        if ($customerId) {
            $customer = Customer::find($customerId);
            // $note = Note::first();
            // dd($note->customer());
            // builder-t adná vissza
            // igy nem: $note->customer()->first()
            // $note->cutomer maga az objektum

            $notes = $customer
                ->notes()
                //->whereDate('created_at', Carbon::now())
                ->orderBy('created_at', 'desc')
                ->get();
        }

        //7. óra
        //csak ami publikált
        $notes = Note::onFrontend()->get();

        return view('frontend.posts.index')->with('notes', $notes);
    }

    //6. óra
    public function create()
    {
        $customer = new Customer();
        $customer->id = \Auth::guard('customer')->user()->id;

        $tags = Tag::orderBy('name')->get();

        return view('frontend.posts.create')
            ->with('customer', $customer)
            ->with('tags', $tags);
    }

    //6. óra
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|min:20'
        ]);

        $note = new Note();

        $note->setAttributes($request->all());
        $note->user_id = auth()->guard('customer')->user()->id;

        //$note->user_id = auth()->guard('customer')->id();
        //$note->user_id = $note->customer()->associate(auth()->guard('customer')->id());
        //$note->customer()->dissociate();

        $note->save();

        //remove tag
        //$note->tags()->detach([2,3]);
        //add tag
        $note->tags()->attach($request->input('tags'));

        session()->flash('message', 'Köszönjük a bejegyzést');

        return redirect()->back();
        //return redirect()->route('notes.index');

    }

    //6. óra
    public function edit($noteId)
    {

        //$note = Note::find($noteId);
        $note = authCustomer()->notes()->findOrFail($noteId);

        $tags = Tag::orderBy('name')->get();

        return view('frontend.posts.edit')
            ->with('note', $note)
            ->with('tags', $tags);
    }

    //6. óra
    public function update(Request $request, $noteId)
    {
        $this->validate($request, [
            'content' => 'required|min:20'
        ]);

        $note = Note::find($noteId);
        //$note->content = $request->input('content');
        $note->setAttributes($request->all());

        //$note->tags()->detach();
        //$note->tags()->attach($request->input('tags'));
        $note->save();

        //$note->tags()->sync([2 => ['weight' => 1]]);
        $note->tags()->sync($request->input('tags'));


        session()->flash('message', 'Köszönjük a módosítást');

        return redirect()->route('posts.index');
    }

    //7. óra
    public function customerWhoUsedLabelNumber2()
    {
        $tagId = 2;

        $customer = Customer::whereHas('notes', function ($query) use ($tagId) {
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('id', $tagId);
            });
        })->get();

        /*dd(Customer::whereHas('notes', function ($query) use ($tagId) {
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('id', $tagId);
            });
        })->toSql());*/

        dd($customer);
    }

    //7. óra
    public function customerHasNote()
    {
        Customer::has('notes', 0)->get();
    }

    //7.óra
    public function notesConnectToTagId3()
    {
        Tag::find(3)->notes();
    }

    //7.óra
    public function notesHasMin2Tag()
    {
        Note::has('tags', '>=', 2);
    }

    //7.óra
    public function ownPosts()
    {
        $notes = authCustomer()->notes()->get();

        //dd($notes);

        return view("frontend.posts.own-posts")->with('notes', $notes);
    }

    //7.óra
    public function destroyDestroyWithJson($noteId)
    {
        $note = Note::findOrFail($noteId);
        $note->delete();

        return response()->json(['message' => 'A post törölve']);
    }

    //7. óra
    public function show($noteId)
    {
        $note = Note::findOrFail($noteId);

        return view('frontend.posts.show')->with('note', $note);

    }
}
