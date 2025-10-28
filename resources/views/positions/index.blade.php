@extends('master')
@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-6 mt-6">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-bold">Daftar Jabatan</h2>
    <a href="{{ route('positions.create') }}" 
       class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700">+ Tambah Jabatan</a>
  </div>

  <table class="min-w-full border border-gray-200">
    <thead class="bg-gray-100">
      <tr>
        <th class="py-2 px-4 border-b text-left">Jabatan</th>
        <th class="py-2 px-4 border-b text-left">Gaji</th>
        <th class="py-2 px-4 border-b text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($positions as $post)
      <tr>
        <td class="py-2 px-4 border-b">{{ $post->nama_jabatan }}</td>
        <td class="py-2 px-4 border-b">{{ $post->gaji_pokok }}</td>
        <td class="py-2 px-4 border-b text-center">
          <a href="{{ route('positions.edit', $post->id) }}" 
             class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg">Edit</a>

          <form action="{{ route('positions.destroy', $post->id) }}" method="POST" class="inline-block"
                onsubmit="return confirm('Yakin ingin menghapus departemen ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
