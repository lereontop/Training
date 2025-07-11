<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Http\Requests\StoreJobRequest;
use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function index()
    {

        $jobs = Job::with('employer')->latest()->get();        
        return response()->json($jobs);
    }

   

    // Show single job page
    public function show(Job $job)
    {
    //   dd($job);
    $job->load('employer');
        return response()->json($job);
    }



    public function store(StoreJobRequest $request)
{
    $validated = $request->validated();

    $job = DB::transaction(function () use ($validated) {
        
        $employer = Employer::create([
            'name' => $validated['employer']['name'],
            'description' => $validated['employer']['description'] ?? null,
            'contactEmail' => $validated['employer']['contactEmail'],
            'contactPhone' => $validated['employer']['contactPhone'],
        ]);

        
        return $employer->jobs()->create([
            'title' => $validated['job']['title'],
            'type' => $validated['job']['type'],
            'description' => $validated['job']['description'],
            'location' => $validated['job']['location'],
            'salary' => $validated['job']['salary'] ?? null,
        ]);
    });

    return response()->json([
        'message' => 'Job and employer created successfully',
        'data' => $job,
    ]);
}


    public function update(Job $job, StoreJobRequest $request)
{
    $validated = $request->validated();

    DB::transaction(function () use ($job, $validated) {
        
        $employer = $job->employer; 

        // Update the employer
        $employer->update([
            'name' => $validated['employer']['name'],
            'description' => $validated['employer']['description'] ?? null,
            'contactEmail' => $validated['employer']['contactEmail'],
            'contactPhone' => $validated['employer']['contactPhone'],
        ]);

        // Update the job
        $job->update([
            'title' => $validated['job']['title'],
            'type' => $validated['job']['type'],
            'description' => $validated['job']['description'],
            'location' => $validated['job']['location'],
            'salary' => $validated['job']['salary'] ?? null,
        ]);
    });

    return response()->json([
        'message' => 'Job and employer updated successfully',
        'data' => $job->fresh('employer'),
    ]);
}


    public function delete(Job $job)
    {
        //authorize  (hold on... )

        //delete the  job
        $job->delete();
        return response()->json(['message'=> 'Job Deleted']);
    }
}
