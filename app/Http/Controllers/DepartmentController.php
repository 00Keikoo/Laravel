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

        return redirect()->route('department.index')->with('success', 'Departemen berhasil ditambahkan');
    }

    public function destroy($id){
        Department::findOrFail($id)->delete();
        return redirect()->route('department.index')->with('success', 'Departemen berhasil dihapus');
    }
}
