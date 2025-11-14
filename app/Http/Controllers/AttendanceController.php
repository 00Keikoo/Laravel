<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['attendances' => function($q) {
            $q->whereDate('tanggal', now()->toDateString());
        }])->get();

        return view('attendances.index', compact('employees'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('attendances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'tipe_absen' => 'required|in:masuk,keluar,izin,sakit',
        ]);

        $today = now()->toDateString();
        $attendance = Attendance::where('employee_id', $validated['employee_id'])
            ->whereDate('tanggal', $today)
            ->first();

        // === Izin atau Sakit ===
        if ($validated['tipe_absen'] === 'izin') {
            Attendance::create([
                'employee_id' => $validated['employee_id'],
                'tanggal' => $today,
                'status_absensi' => 'izin',
            ]);

            return back()->with('success', 'Izin berhasil dicatat.');
        }

        if ($validated['tipe_absen'] === 'sakit') {
            Attendance::create([
                'employee_id' => $validated['employee_id'],
                'tanggal' => $today,
                'status_absensi' => 'sakit',
            ]);

            return back()->with('success', 'Sakit berhasil dicatat.');
        }

        // === Absen Masuk ===
        if ($validated['tipe_absen'] === 'masuk') {
            if ($attendance) {
                return back()->with('error', 'Pegawai ini sudah absen masuk hari ini!');
            }

            Attendance::create([
                'employee_id' => $validated['employee_id'],
                'tanggal' => $today,
                'status_absensi' => 'hadir',
                'waktu_masuk' => now(),
            ]);

            return back()->with('success', 'Absen masuk berhasil dicatat.');
        }

        // === Absen Keluar ===
        if ($validated['tipe_absen'] === 'keluar') {
            if (!$attendance) {
                return back()->with('error', 'Pegawai ini belum absen masuk!');
            }

            if ($attendance->waktu_keluar) {
                return back()->with('error', 'Pegawai ini sudah absen keluar!');
            }

            $attendance->update([
                'waktu_keluar' => now(),
            ]);

            return back()->with('success', 'Absen keluar berhasil dicatat.');
        }
    }

    public function destroy($id)
    {
        Attendance::findOrFail($id)->delete();
        return redirect()->route('attendance.index')->with('success', 'Data absensi berhasil dihapus');
    }
}
