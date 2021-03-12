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
        //$lastThreeCustomer = Comment::orderBy('created_at', 'desc')->take(3)->get();
        $lastThreeCustomer = Comment::orderBy('created_at', 'desc')->pluck('customer_id')->toArray();
        $lastThreeCustomer = array_unique($lastThreeCustomer);
        $firstThree = array_slice($lastThreeCustomer, 0, 3);

        $lastThreeCustomer = Customer::whereIn('id', $firstThree)->get();

        return view('frontend.statistics.queries', compact('lastThreeCustomer'));

    }

    public function mostCommentingCustomer()
    {

        $mostCommentingCustomer = Comment::selectRaw('customer_id, count(*) AS sum')
            ->groupBy('customer_id')
            ->orderBy('sum', 'desc')
            ->first();

/*
        //////////////////
        $customer = Customer::has('comments')->get();
        $mostCommentingCustomer = $customer->sortBy(function ($customer) {
            $customer->comments->count();
        })->first();


        //////////
        $mostCommentingCustomer = Customer::withCount('comments')->orderBy('comments_count', 'desc')->first();
       */

        return view('frontend.statistics.queries', compact('mostCommentingCustomer'));

    }

    public function customerReceivedMostComments()
    {
        $customerReceivedMostComments = Comment::selectRaw('note_id, count(*) AS sum')
            ->groupBy('note_id')
            ->orderBy('sum', 'desc')
            ->first();

        //////////////////
        /*
        $customerArray = [];
        foreach (Customer::has('notes')->get() as $customerWithNote) {
            $customerCommentCount = 0;

            foreach ($customerWithNote->notes as $customerNote) {
                $customerCommentCount += $customerNote->comments()->count();
            }
            $customerArray[$customerWithNote->id] = $customerCommentCount;
        }

        asort($customerArray);
        $keys = array_keys($customerArray);
        $id = array_pop($keys);

        $customerReceivedMostComments = Customer::find($id);
        dd($customerReceivedMostComments);*/

        return view('frontend.statistics.queries', compact('customerReceivedMostComments'));

    }

    public function mostCommentedNote()
    {
        $mostCommentedNote = Comment::selectRaw('note_id, count(*) AS sum')
            ->groupBy('note_id')
            ->orderBy('sum', 'desc')
            ->first();

        ///////////////
        //$mostCommentedNote = Note::withCount('comments')->orderBy('comments_count', 'desc')->first();


        return view('frontend.statistics.queries', compact('mostCommentedNote'));
    }

    public function mostCommentedTag()
    {

        $tagArray = [];
        foreach (Tag::has('notes')->get() as $tagWithNote) {
            $tagCommentCount = 0;

            foreach ($tagWithNote->notes as $tagNote) {
                $tagCommentCount += $tagNote->comments()->count();
            }
            $tagArray[$tagWithNote->id] = $tagCommentCount;
        }

        asort($tagArray);
        $keys = array_keys($tagArray);
        $id = array_pop($keys);

        $searchedNote = Tag::find($id);

        return view('frontend.statistics.queries', compact('searchedNote'));
    }
}
