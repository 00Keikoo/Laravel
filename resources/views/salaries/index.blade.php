@extends('master')
@section('content')
<div class="container mx-auto py-8">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Data Gaji Pegawai</h1>
    <a href="{{ route('salaries.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
      + Tambah Gaji
    </a>
  </div>

  <div class="overflow-x-auto bg-white shadow rounded-xl">
    <table class="min-w-full">
      <thead class="bg-blue-600 text-white">
        <tr>
          <th class="py-2 px-4 text-left">Nama</th>
          <th class="py-2 px-4">Bulan</th>
          <th class="py-2 px-4">Gaji Pokok</th>
          <th class="py-2 px-4">Tunjangan</th>
          <th class="py-2 px-4">Potongan</th>
          <th class="py-2 px-4">Total</th>
          <th class="py-2 px-4 text-center">Aksi</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($salaries as $s)
        <tr class="border-b hover:bg-gray-50">
          <td class="py-2 px-4">{{ $s->employee->nama_lengkap ?? '-' }}</td>
          <td class="py-2 px-4">{{ $s->bulan }}</td>
          <td class="py-2 px-4">{{ number_format($s->gaji_pokok) }}</td>
          <td class="py-2 px-4">{{ number_format($s->tunjangan) }}</td>
          <td class="py-2 px-4 text-red-600">-{{ number_format($s->potongan) }}</td>
          <td class="py-2 px-4 font-semibold">{{ number_format($s->total_gaji) }}</td>
          <td class="py-2 px-4 text-center space-x-2">
            <a href="{{ route('salaries.edit', $s->id) }}" 
               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg transition">
              Edit
            </a>

            <form action="{{ route('salaries.destroy', $s->id) }}" method="POST" class="inline-block"
                  onsubmit="return confirm('Yakin ingin menghapus data gaji ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" 
                      class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition">
                Hapus
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
