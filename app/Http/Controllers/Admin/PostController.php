<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attachment;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Note;
use App\Http\Controllers\Controller;

class PostController extends Controller
{


    public function index($customerId = null)
    {

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

        $notes = Note::orderBy('created_at', 'desc')->paginate(3);

        return view('admin.posts.index')->with('notes', $notes);
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        //$customer->id = \Auth::guard()->user()->id;

        $tags = Tag::orderBy('name')->get();

        return view('admin.posts.create')
            ->with('customers', $customers)
            ->with('tags', $tags);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:customers,id',
            'content' => 'required|min:20',
        ]);

        $note = new Note();

        $note->setAttributes($request->all());
        $note->user_id = auth()->guard()->user()->id;
        $note->save();

        $note->tags()->attach($request->input('tags'));

        session()->flash('message', 'Köszönjük a bejegyzést');

        return redirect()->back();

    }

    public function edit($noteId)
    {

        $note = Note::findOrFail($noteId);

        $tags = Tag::orderBy('name')->get();

        return view('admin.posts.edit')
            ->with('note', $note)
            ->with('tags', $tags);
    }


    public function update(Request $request, $noteId)
    {
        $this->validate($request, [
            'content' => 'required|min:2'
        ]);

        try {

            $note = Note::find($noteId);
            $note->setAttributes($request->all());
            $note->save();

            $note->tags()->sync($request->input('tags'));

            if ($file = $request->file('attachment')) {

                try {
                    $attachment = new Attachment;
                    $attachment->addFile($file);

                    $attachment->attachable()->associate($note);

                    $attachment->save();

                } catch (\Exception $e) {
                    session()->flash('error', $e->getMessage());
                }
            }

            session()->flash('success', 'Bejegyzés módosítva');

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('admin.posts.index', ['page' => request()->input('page')]);
    }

    public function show($noteId)
    {
        $note = Note::findOrFail($noteId);

        return view('admin.posts.show')->with('note', $note);

    }
}
