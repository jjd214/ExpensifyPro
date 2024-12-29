<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApprovalRequest;
use App\Http\Requests\UpdateApprovalRequest;
use App\Http\Resources\ApprovalResource;
use App\Models\Approval;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->input('search') ?? '';
        $approvals = Approval::search($search)->paginate(5)->withQueryString();
        return Inertia::render('Approver/Approval/Index', [
            'approvals' => ApprovalResource::collection($approvals)
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
    public function store(StoreApprovalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $approval = Approval::findOrFail($id);
        return Inertia::render('Approver/Approval/Show', [
            'approval' => new ApprovalResource($approval)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Approval $approval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApprovalRequest $request, Approval $approval)
    {
        //
        $approval->update($request->all());
        $approval->expense->update(['status' => $approval->status]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Approval $approval)
    {
        //
    }
}
