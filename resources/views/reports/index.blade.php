@extends('master')
@section('content')

<div class="max-w-6xl mx-auto bg-white shadow-md rounded-xl p-6 mt-8">
    <h2 class="text-2xl font-bold mb-4 text-center">Laporan Kehadiran Pegawai</h2>

    <!-- Filter Bulan & Tahun -->
    <form method="GET" action="{{ route('report.index') }}" class="flex justify-center gap-4 mb-6">
        <select name="month" class="border rounded-lg p-2">
            @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                </option>
            @endforeach
        </select>

        <select name="year" class="border rounded-lg p-2">
            @foreach(range(date('Y') - 3, date('Y')) as $y)
                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Tampilkan
        </button>
    </form>

    <!-- Tabel Laporan -->
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Nama Pegawai</th>
                    <th class="py-3 px-4 text-center">Hadir</th>
                    <th class="py-3 px-4 text-center">Izin</th>
                    <th class="py-3 px-4 text-center">Sakit</th>
                    <th class="py-3 px-4 text-center">Alpa</th>
                    <th class="py-3 px-4 text-center">Total Hari</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $r)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="py-3 px-4">{{ $r->employee->nama_lengkap ?? 'Tidak diketahui' }}</td>
                    <td class="py-3 px-4 text-center text-green-600 font-semibold">{{ $r->hadir }}</td>
                    <td class="py-3 px-4 text-center text-yellow-600 font-semibold">{{ $r->izin }}</td>
                    <td class="py-3 px-4 text-center text-blue-600 font-semibold">{{ $r->sakit }}</td>
                    <td class="py-3 px-4 text-center text-red-600 font-semibold">{{ $r->alpa }}</td>
                    <td class="py-3 px-4 text-center font-bold">{{ $r->total_hari }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada data untuk bulan ini</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
