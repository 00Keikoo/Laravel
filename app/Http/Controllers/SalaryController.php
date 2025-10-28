<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee')->get();
        return view('salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::with('position')->latest()->get();
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
        ]);

        // Hitung otomatis total gaji
        $validated['total_gaji'] = ($validated['gaji_pokok'] ?? 0) + ($validated['tunjangan'] ?? 0) - ($validated['potongan'] ?? 0);

        Salary::create($validated);
        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil ditambahkan');
    }

    public function edit($id)
    {
        $salary = Salary::findOrFail($id);
        $employees = Employee::with('position')->latest()->get();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
        ]);

        $validated['total_gaji'] = ($validated['gaji_pokok'] ?? 0) + ($validated['tunjangan'] ?? 0) - ($validated['potongan'] ?? 0);

        $salary = Salary::findOrFail($id);
        $salary->update($validated);

        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil diperbarui');
    }

    public function destroy($id)
    {
        $salary = Salary::findOrFail($id);
        $salary->delete();
        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil dihapus');
    }
}
