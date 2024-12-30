<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePolicyRequest;
use App\Http\Requests\UpdatePolicyRequest;
use App\Http\Resources\PolicyResource;
use App\Models\Category;
use App\Models\Policy;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->input('search') ?? '';
        $policies = Policy::search($search)->paginate(5);
        return Inertia::render('Admin/Policy/Index', [
            'policies' => PolicyResource::collection($policies)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = Category::select('id', 'name')->get();
        return Inertia::render('Admin/Policy/Create', [
            'categories' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePolicyRequest $request)
    {
        //
        Policy::create($request->all());
        return redirect()->route('admin.policy.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Policy $policy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Policy $policy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePolicyRequest $request, Policy $policy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Policy $policy)
    {
        //
    }
}
