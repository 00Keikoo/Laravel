@extends('master')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-6">
  <h2 class="text-2xl font-bold mb-6 text-center">Data Absensi Hari Ini</h2>

  <!-- Notifikasi -->
  @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
      {{ session('error') }}
    </div>
  @endif

  <table class="w-full border-collapse">
    <thead>
      <tr class="bg-gray-100 text-gray-700">
        <th class="py-3 px-4 border">No</th>
        <th class="py-3 px-4 border">Nama Pegawai</th>
        <th class="py-3 px-4 border">Jabatan</th>
        <th class="py-3 px-4 border">Status</th>
        <th class="py-3 px-4 border">Waktu Masuk</th>
        <th class="py-3 px-4 border">Waktu Keluar</th>
        <th class="py-3 px-4 border">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($employees as $index => $employee)
        @php
          $todayAttendance = $employee->attendances->first();
        @endphp

        <tr class="hover:bg-gray-50 text-center">
          <td class="border py-2 px-4">{{ $index + 1 }}</td>
          <td class="border py-2 px-4">{{ $employee->nama_lengkap }}</td>
          <td class="border py-2 px-4">{{ $employee->position->nama_jabatan ?? '-' }}</td>

          <!-- STATUS -->
          <td class="border py-2 px-4 font-semibold">
            @if(!$todayAttendance)
              <span class="text-red-600">Belum Absen</span>

            @elseif($todayAttendance->status_absensi === 'izin')
              <span class="text-blue-600">Izin</span>

            @elseif($todayAttendance->status_absensi === 'sakit')
              <span class="text-purple-600">Sakit</span>

            @elseif($todayAttendance->status_absensi === 'hadir' && !$todayAttendance->waktu_keluar)
              <span class="text-yellow-600">⏰ Masih Bekerja</span>

            @elseif($todayAttendance->status_absensi === 'hadir' && $todayAttendance->waktu_keluar)
              <span class="text-green-600">Selesai</span>
            @endif
          </td>

          <!-- Waktu Masuk -->
          <td class="border py-2 px-4">
            {{ $todayAttendance?->waktu_masuk ? \Carbon\Carbon::parse($todayAttendance->waktu_masuk)->format('H:i') : '-' }}
          </td>

          <!-- Waktu Keluar -->
          <td class="border py-2 px-4">
            {{ $todayAttendance?->waktu_keluar ? \Carbon\Carbon::parse($todayAttendance->waktu_keluar)->format('H:i') : '-' }}
          </td>

          <!-- Aksi -->
          <td class="border py-2 px-4 space-x-2">

            @if(!$todayAttendance)
              <!-- Absen Masuk -->
              <form action="{{ route('attendance.store') }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                <input type="hidden" name="tipe_absen" value="masuk">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                  Absen Masuk
                </button>
              </form>

              <!-- Izin -->
              <form action="{{ route('attendance.store') }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                <input type="hidden" name="tipe_absen" value="izin">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                  Izin
                </button>
              </form>

              <!-- Sakit -->
              <form action="{{ route('attendance.store') }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                <input type="hidden" name="tipe_absen" value="sakit">
                <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white px-3 py-1 rounded">
                  Sakit
                </button>
              </form>

            @elseif($todayAttendance->status_absensi === 'hadir' && !$todayAttendance->waktu_keluar)
              <!-- Absen Keluar -->
              <form action="{{ route('attendance.store') }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                <input type="hidden" name="tipe_absen" value="keluar">
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                  Absen Keluar
                </button>
              </form>

            @else
              <span class="text-gray-500 italic">Selesai</span>
            @endif

          </td>

        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
