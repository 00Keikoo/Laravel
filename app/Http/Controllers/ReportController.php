<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Opsi filter bulan & tahun
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Ambil data rekap absensi berdasarkan pegawai
        $reports = Attendance::select(
                'employee_id',
                DB::raw("SUM(CASE WHEN status_absensi = 'hadir' THEN 1 ELSE 0 END) as hadir"),
                DB::raw("SUM(CASE WHEN status_absensi = 'izin' THEN 1 ELSE 0 END) as izin"),
                DB::raw("SUM(CASE WHEN status_absensi = 'sakit' THEN 1 ELSE 0 END) as sakit"),
                DB::raw("SUM(CASE WHEN status_absensi = 'alpa' THEN 1 ELSE 0 END) as alpa"),
                DB::raw("COUNT(*) as total_hari")
            )
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->groupBy('employee_id')
            ->with('employee')
            ->get();

        $employees = Employee::all();

        return view('reports.index', compact('reports', 'month', 'year', 'employees'));
    }

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }

}
