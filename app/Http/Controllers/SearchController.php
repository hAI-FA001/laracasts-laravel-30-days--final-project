<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke()
    {
        // add a query() so we can keep each filter/method on its own line
        $jobs = Job::query()
        ->with(['tags', 'employer'])
        ->where('title', 'LIKE', '%'.request('q').'%')
        ->get();
        return view('results', ['jobs' => $jobs]);
    }
}
