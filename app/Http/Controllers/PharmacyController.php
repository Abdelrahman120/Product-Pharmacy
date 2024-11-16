<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pharmacies = Pharmacy::paginate(10);
        return view('Pharmacies.index', compact('pharmacies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pharmacies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        Pharmacy::create($request->all());
        return redirect()->route('Pharmacies.index')->with('success', 'Pharmacy created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        return view('Pharmacies.show', compact('pharmacy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        return view('Pharmacies.edit', compact('pharmacy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->update($request->all());
        return redirect()->route('Pharmacies.index')->with('success', 'Pharmacy updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->delete();
        return redirect()->route('Pharmacies.index')->with('success', 'Pharmacy deleted successfully');
    }
}
