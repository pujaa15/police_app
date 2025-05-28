<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    
    
    public function index(Request $request)
{
    $vehicles = Vehicle::all(); // sementara tampilkan semua data

    if ($request->wantsJson()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Data kendaraan ditemukan',
            'data' => $vehicles,
        ]);
    }

    return view('vehicles.index', compact('vehicles'));
}

    public function create(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Endpoint tidak tersedia untuk API'], 404);
        }

        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'license_plate' => 'required|string|unique:vehicles,license_plate',
            'type' => 'required|string',
            'brand' => 'required|string',
            'color' => 'required|string',
        ], [
            'license_plate.required' => 'Nomor plat kendaraan wajib diisi',
            'license_plate.unique' => 'Nomor plat kendaraan sudah terdaftar',
            'type.required' => 'Tipe kendaraan wajib diisi',
            'brand.required' => 'Merek kendaraan wajib diisi',
            'color.required' => 'Warna kendaraan wajib diisi',
        ]);

        $vehicle = Vehicle::create([
            'user_id' => auth()->id(),
            'license_plate' => $validated['license_plate'],
            'type' => $validated['type'],
            'brand' => $validated['brand'],
            'color' => $validated['color'],
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data kendaraan berhasil ditambahkan',
                'data' => $vehicle,
            ], 201);
        }

        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        $vehicle = Vehicle::where('user_id', auth()->id())->findOrFail($id);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data kendaraan ditemukan',
                'data' => $vehicle,
            ]);
        }

        return redirect()->route('vehicles.index');
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::where('user_id', auth()->id())->findOrFail($id);

        $validated = $request->validate([
            'license_plate' => 'required|string|unique:vehicles,license_plate,' . $vehicle->id,
            'type' => 'required|string',
            'brand' => 'required|string',
            'color' => 'required|string',
        ], [
            'license_plate.required' => 'Nomor plat kendaraan wajib diisi',
            'license_plate.unique' => 'Nomor plat kendaraan sudah terdaftar',
            'type.required' => 'Tipe kendaraan wajib diisi',
            'brand.required' => 'Merek kendaraan wajib diisi',
            'color.required' => 'Warna kendaraan wajib diisi',
        ]);

        $vehicle->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data kendaraan berhasil diubah',
                'data' => $vehicle,
            ]);
        }

        return redirect()->route('vehicles.index')->with('success', 'Data kendaraan berhasil diubah.');
    }

    public function destroy(Request $request, $id)
    {
        $vehicle = Vehicle::where('user_id', auth()->id())->findOrFail($id);
        $vehicle->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data kendaraan berhasil dihapus',
                'data' => [],
            ]);
        }

        return redirect()->route('vehicles.index')->with('success', 'Data kendaraan berhasil dihapus.');
    }
}