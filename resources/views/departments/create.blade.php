@extends('master')
@section('content')
<div class="max-w-lg mx-auto bg-white shadow-md rounded-xl p-6 mt-6">
  <h2 class="text-xl font-bold mb-4 text-center">Tambah Departemen</h2>

  <form action="{{ route('departments.store') }}" method="POST">
    @csrf

    <label class="block mb-2">Nama Departemen</label>
    <input type="text" name="nama_departemen" class="w-full border rounded p-2 mb-4" required>

    <label class="block mb-2">Deskripsi</label>
    <textarea name="deskripsi" class="w-full border rounded p-2 mb-4"></textarea>

    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
      Simpan
    </button>
  </form>
</div>
@endsection
