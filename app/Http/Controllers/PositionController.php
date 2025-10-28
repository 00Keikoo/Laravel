<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(){
        $positions = Position::all();
        return view('positions.index', compact('positions'));
    }

    public function show($id){
        $positions = Position::with('employees')->findOrFail($id);
        $employees = Employee::where('department_id', $id)->get();

        return view('positions.show', compact('positions'));
    }

    public function create(){
        return view('positions.create');
    }

    public function edit($id){
        $positions = Position::findOrFail($id);
        return view('positions.edit', compact('positions'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'nullable|numeric',
        ]);

        Position::create($validated);

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil ditambahkan');
    }

    public function destroy($id){
        Position::findOrFail($id)->delete();
        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil dihapus');
    }
}
