<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Inertia\Inertia;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $userId = Auth::id();
        $search = $request->input('search') ?? '';
        $expense = Expense::search($search)->where('user_id', $userId)->paginate(2)->withQueryString();
        return Inertia::render('Employee/Expense/Index', [
            'expenses' => ExpenseResource::collection($expense)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = Category::select('id', 'name')->get();
        return Inertia::render('Employee/Expense/Create', [
            'categories' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        //
        $expense = Expense::create($request->all());
        $expense->approval()->create([$expense]);
        return redirect()->route('employee.expense.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $categories = Category::select('id', 'name')->get();
        $expense = Expense::findOrFail($id);
        return Inertia::render('Employee/Expense/Edit', [
            'categories' => $categories,
            'expense' => new ExpenseResource($expense)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        //
        $expense->update($request->all());
        return redirect()->route('employee.expense.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
        $expense->delete();
        return redirect()->route('employee.expense.index');
    }
}
