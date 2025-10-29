<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    public function show($id){
        $department = Department::with('employees')->findOrFail($id);
        $employees = Employee::where('departemen_id', $id)->get();

        return view('departments.show', compact('department', 'employees'));
    }

    public function create(){
        return view('departments.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nama_departement' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Department::create($validated);

        return redirect()->route('departments.index')->with('success', 'Departemen berhasil ditambahkan');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_departemen' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($id);
        $department->update($validated);

        return redirect()->route('departments.index')->with('success', 'Departemen berhasil diperbarui.');
    }


    public function destroy($id){
        Department::findOrFail($id)->delete();
        return redirect()->route('departments.index')->with('success', 'Departemen berhasil dihapus');
    }
}
