<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\CustomersExport;
use App\Imports\CustomersImport;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $customers = Customer::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->appends(['search' => $search]); // Append search query to pagination links

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string|max:15',
        ]);

        Customer::create($validated);
        return redirect()->route('customers.index')->with('success', 'Customer added successfully!');
    }

    public function show(Customer $customer)
    {
        // Eager load sales for the customer
        $customer->load('sales');
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|max:15',
        ]);

        $customer->update($validated);
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete(); // Soft delete
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }

    // Get all the deleted records
    public function recycleBin()
    {
        $deletedCustomers = Customer::onlyTrashed()->paginate(10);
        return view('customers.recycle-bin', compact('deletedCustomers'));
    }

    // Restore customer
    public function restore($id)
    {
        $customer = Customer::onlyTrashed()->findOrFail($id);
        $customer->restore();

        return redirect()->route('customers.recycle-bin')->with('success', 'Customer restored successfully!');
    }

    // Import customers via CSV or Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx',
        ]);

        Excel::import(new CustomersImport, $request->file('file'));

        return redirect()->route('customers.index')->with('success', 'Customers imported successfully!');
    }

    // Export customers as CSV or Excel
    public function export()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }
}
