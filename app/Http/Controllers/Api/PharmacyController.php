<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::paginate(10);

        return response()->json([
            'success' => true,
            'data' => $pharmacies,
            'message' => 'Pharmacies retrieved successfully'
        ], 200);
    }

    public function show($id)
    {
        $pharmacy = Pharmacy::find($id);

        if ($pharmacy) {
            return response()->json([
                'success' => true,
                'data' => $pharmacy,
                'message' => 'Pharmacy retrieved successfully'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Pharmacy not found'
        ], 404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $pharmacy = Pharmacy::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $pharmacy,
            'message' => 'Pharmacy created successfully'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $pharmacy = Pharmacy::find($id);

        if (!$pharmacy) {
            return response()->json([
                'success' => false,
                'message' => 'Pharmacy not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $pharmacy->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $pharmacy,
            'message' => 'Pharmacy updated successfully'
        ], 200);
    }

    public function destroy($id)
    {
        $pharmacy = Pharmacy::find($id);

        if (!$pharmacy) {
            return response()->json([
                'success' => false,
                'message' => 'Pharmacy not found'
            ], 404);
        }

        $pharmacy->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pharmacy deleted successfully'
        ], 200);
    }
}
