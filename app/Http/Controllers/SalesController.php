<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Imports\SalesImport;
use Maatwebsite\Excel\Facades\Excel;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('customer')->paginate(10); // Include related customer data
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all(); // Fetch all customers for the dropdown
        return view('sales.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        Sale::create($validated);

        return redirect()->route('sales.index')->with('success', 'Sale added successfully!');
    }

    public function show(Sale $sale)
    {
        return view('sales.show', compact('sale'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $customers = Customer::all(); // Fetch all customers for the dropdown
        return view('sales.edit', compact('sale', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $sale->update($validated);

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx',
        ]);

        Excel::import(new SalesImport, $request->file('file'));

        return redirect()->route('sales.index')->with('success', 'Sales imported successfully!');
    }
}
