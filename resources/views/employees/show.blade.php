<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pegawai</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    @extends('master')
    @section('page-title', 'Detail Pegawai')
    @section('content');

    {{-- Header --}}
    <header class="bg-indigo-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Detail Pegawai</h1>
            <a href="{{ url('/employees') }}" class="text-sm bg-white text-indigo-600 px-3 py-1 rounded-md hover:bg-gray-100 transition">Kembali</a>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-grow flex justify-center items-start py-10 px-4">
        <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-2xl">
            <div class="flex items-center space-x-4 border-b pb-4 mb-6">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center">
                    <span class="text-indigo-600 text-2xl font-bold">
                        {{ strtoupper(substr($employee->nama_lengkap, 0, 1)) }}
                    </span>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $employee->nama_lengkap }}</h2>
                    <p class="text-gray-500 text-sm">{{ $employee->email }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500">Nomor Telepon</p>
                    <p class="font-medium text-gray-800">{{ $employee->nomor_telepon }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Lahir</p>
                    <p class="font-medium text-gray-800">{{ $employee->tanggal_lahir }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Alamat</p>
                    <p class="font-medium text-gray-800">{{ $employee->alamat }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Masuk</p>
                    <p class="font-medium text-gray-800">{{ $employee->tanggal_masuk }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium 
                        {{ $employee->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ ucfirst($employee->status) }}
                    </span>
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('employees.edit', $employee->id) }}" 
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
                   Edit
                </a>
                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-100 text-center py-4 text-sm text-gray-500">
        &copy; {{ date('Y') }} App Pegawai. All rights reserved.
    </footer>
    @endsection
</body>
</html>
