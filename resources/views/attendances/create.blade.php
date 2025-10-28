@extends('master')
@section('content')
<div class="max-w-lg mx-auto bg-white shadow-md rounded-xl p-6 mt-6">
  <h2 class="text-xl font-bold mb-4 text-center">Form Absensi Pegawai</h2>

  {{-- Pesan sukses / error --}}
  @if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
      {{ session('error') }}
    </div>
  @endif

  <form action="{{ route('attendance.store') }}" method="POST">
    @csrf

    <label class="block mb-2">Nama Pegawai</label>
    <select name="employee_id" class="w-full border rounded p-2 mb-4" required>
      <option value="">-- Pilih Pegawai --</option>
      @foreach ($employees as $emp)
        <option value="{{ $emp->id }}">{{ $emp->nama_lengkap }}</option>
      @endforeach
    </select>

    <label class="block mb-2">Tipe Absensi</label>
    <select name="tipe_absen" class="w-full border rounded p-2 mb-4" required>
      <option value="masuk">Absen Masuk</option>
      <option value="keluar">Absen Keluar</option>
    </select>

    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition w-full">
      Simpan Absensi
    </button>
  </form>
</div>
@endsection
