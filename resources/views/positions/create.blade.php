@extends('master')
@section('content')
<div class="max-w-lg mx-auto bg-white shadow-md rounded-xl p-6 mt-6">
  <h2 class="text-xl font-bold mb-4 text-center">Tambah Jabatan</h2>

  @if ($errors->any())
  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif


  <form action="{{ route('positions.store') }}" method="POST">
    @csrf

    <label class="block mb-2">Nama Jabatan</label>
    <input type="text" name="nama_jabatan" class="w-full border rounded p-2 mb-4" required>

    <label class="block mb-2">Gaji</label>
    <textarea name="gaji_pokok" class="w-full border rounded p-2 mb-4"></textarea>

    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
      Simpan
    </button>
  </form>
</div>
@endsection
