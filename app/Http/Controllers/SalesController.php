<?php

namespace App\Http\Controllers;

use App\Events\SalesEvent;
use App\Models\Sale;
use App\Models\Customer;
use App\Exports\SalesExport;
use App\Imports\SalesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SalesController extends Controller
{
    /**
     * Display a listing of the sales.
     */

    public function index(Request $request)
    {
        $search = $request->input('search');

        $sales = Sale::with('customer')
            ->when($search, function ($query, $search) {
                return $query->where('product_name', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            })
            ->paginate(10)
            ->appends(['search' => $search]); // Append search query to pagination links

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

        $sale = Sale::create($validated);
        // Trigger the SalesEvent
        event(new SalesEvent($sale));
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

    // Get all the deleted records
    public function recycleBin()
    {
        $deletedSales = Sale::onlyTrashed()->with('customer')->paginate(10);
        return view('sales.recycle-bin', compact('deletedSales'));
    }

    // Restore sales
    public function restore($id)
    {
        $sale = Sale::onlyTrashed()->findOrFail($id);
        $sale->restore();

        return redirect()->route('sales.recycle-bin')->with('success', 'Sale restored successfully!');
    }

    // Import sales via CSV or Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx',
        ]);

        Excel::import(new SalesImport, $request->file('file'));

        return redirect()->route('sales.index')->with('success', 'Sales imported successfully!');
    }

    // Export sales as CSV or Excel
    public function export()
    {
        return Excel::download(new SalesExport, 'sales.xlsx');
    }
}
