<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\PolicyResource;
use App\Models\Policy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $policies = Policy::all();
        return Inertia::render('Employee/Policy/Index', [
            'policies' => PolicyResource::collection($policies)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $policy = Policy::findOrFail($id);
        return Inertia::render('Employee/Policy/Show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
