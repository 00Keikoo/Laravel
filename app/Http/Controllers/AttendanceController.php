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
            'tipe_absen' => 'required|in:masuk,keluar',
        ]);

        $today = Carbon::today();

        $attendance = Attendance::where('employee_id', $validated['employee_id'])
            ->whereDate('tanggal', $today)
            ->first();

        // === Absen Masuk ===
        if ($validated['tipe_absen'] === 'masuk') {
            if ($attendance) {
                return redirect()->back()->with('error', 'Pegawai ini sudah absen masuk hari ini!');
            }

            Attendance::create([
                'employee_id' => $validated['employee_id'],
                'tanggal' => $today,
                'status_absensi' => 'hadir',
                'waktu_masuk' => now(),
            ]);

            return redirect()->route('attendance.index')->with('success', 'Absen masuk berhasil dicatat.');
        }

        // === Absen Keluar ===
        if (!$attendance) {
            return redirect()->back()->with('error', 'Pegawai ini belum absen masuk!');
        }

        if ($attendance->waktu_keluar) {
            return redirect()->back()->with('error', 'Pegawai ini sudah absen keluar hari ini!');
        }

        $attendance->update([
            'waktu_keluar' => now(),
        ]);

        return redirect()->route('attendance.index')->with('success', 'Absen keluar berhasil dicatat.');
    }

    public function destroy($id)
    {
        Attendance::findOrFail($id)->delete();
        return redirect()->route('attendance.index')->with('success', 'Data absensi berhasil dihapus');
    }
}
