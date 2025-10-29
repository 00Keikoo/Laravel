@extends('master')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-md rounded-xl p-6 mt-6">
  <h2 class="text-xl font-bold mb-4 text-center">Edit Departemen</h2>

  <form action="{{ route('departments.update', $department->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label class="block mb-2 font-semibold">Nama Departemen</label>
    <input type="text" name="nama_departemen"
           value="{{ old('nama_departemen', $department->nama_departemen) }}"
           class="w-full border rounded p-2 mb-4" required>
    <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
      Simpan Perubahan
    </button>
  </form>
</div>
@endsection
