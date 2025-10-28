@extends('master')
@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-6 mt-6">
  <h2 class="text-xl font-bold mb-4">
    Pegawai di Departemen: {{ $positions->nama_jabatan }}
  </h2>

  <p class="text-gray-600 mb-6">{{ $positions->gaji_pokok }}</p>

  @if ($employees->isEmpty())
    <p class="text-gray-500">Belum ada pegawai di Jabatan ini.</p>
  @else
  <table class="min-w-full border border-gray-200">
    <thead class="bg-gray-100">
      <tr>
        <th class="py-2 px-4 border-b text-left">Nama Pegawai</th>
        <th class="py-2 px-4 border-b text-left">Kelas</th>
        <th class="py-2 px-4 border-b text-center">Tanggal Masuk</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($employees as $emp)
      <tr>
        <td class="py-2 px-4 border-b">{{ $emp->nama_lengkap }}</td>
        <td class="py-2 px-4 border-b">{{ $emp->kelas ?? '-' }}</td>
        <td class="py-2 px-4 border-b text-center">{{ $emp->tanggal_masuk }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif
</div>
@endsection
