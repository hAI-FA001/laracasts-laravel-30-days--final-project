<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->get()->groupBy('featured');

        
        return view('jobs.index', [
            'featuredJobs' => $jobs[1],
            'jobs' => $jobs[0],
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attrs = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'url' => ['required', 'active_url'],  # make sure it's a URL and is active
            'tags' => ['nullable'],
        ]);

        $attrs['featured'] = $request->has('featured');

        // in jobs->create, employer ID set automatically
        // further, in user->employer, we remove the opportunity to fake who the current user is
        // unless you're signed in, you can't make a job under a different employer
        $job = Auth::user()->employer->jobs()->create(Arr::except($attrs, 'tags'));

        // handle the optional tags
        // "?? false" may not be needed
        if($attrs['featured'] ?? false) {
            foreach (explode(',', $attrs['tags']) as $tag) {
                $job->tag($tag);
            }
        }

        return redirect('/');
    }
}
