@extends('master')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Edit Jabatan</h2>

    <form action="{{ route('positions.update', $positions->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama_jabatan" class="block text-gray-700 font-semibold mb-2">Nama Jabatan</label>
            <input type="text" name="nama_jabatan" id="nama_jabatan"
                value="{{ old('nama_jabatan', $positions->nama_jabatan) }}"
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('nama_jabatan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="gaji_pokok" class="block text-gray-700 font-semibold mb-2">Gaji Pokok</label>
            <input type="number" name="gaji_pokok" id="gaji_pokok"
                value="{{ old('gaji_pokok', $positions->gaji_pokok) }}"
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('gaji_pokok')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('positions.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Batal
            </a>
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
