<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Customer;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {

        return view('frontend.statistics.index');
    }

    public function lastThreeCustomer()
    {
        $lastThreeCustomer = Comment::orderBy('created_at', 'desc')->take(3)->get();

        return view('frontend.statistics.queries', compact('lastThreeCustomer'));

    }

    public function mostCommentingCustomer()
    {

        $mostCommentingCustomer = Comment::selectRaw('customer_id, count(*) AS sum')
            ->groupBy('customer_id')
            ->orderBy('sum', 'desc')
            ->first();

        return view('frontend.statistics.queries', compact('mostCommentingCustomer'));

    }

    public function customerReceivedMostComments()
    {
        $customerReceivedMostComments = Comment::selectRaw('note_id, count(*) AS sum')
            ->groupBy('note_id')
            ->orderBy('sum', 'desc')
            ->first();

        return view('frontend.statistics.queries', compact('customerReceivedMostComments'));

    }

    public function mostCommentedNote()
    {
        $mostCommentedNote = Comment::selectRaw('note_id, count(*) AS sum')
            ->groupBy('note_id')
            ->orderBy('sum', 'desc')
            ->first();

        return view('frontend.statistics.queries', compact('mostCommentedNote'));
    }

    public function mostCommentedTag()
    {
        $mostCommentedTag = Note::whereHas('tags', function ($query) {
            $query->whereIn('comments', function ($q) {
            });
        })->get();

        dd($mostCommentedTag);


        /*dd(Customer::whereHas('notes', function ($query) use ($tagId) {
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('id', $tagId);
            });
        })->toSql());*/

        return view('frontend.statistics.queries', compact('mostCommentedTag'));
    }
}
