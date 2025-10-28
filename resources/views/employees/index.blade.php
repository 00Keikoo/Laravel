<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pegawai</title>
    <!-- Tambahkan Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    @extends('master')
    @section('title', 'Daftar Pegawai')
    @section('content')

    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Pegawai</h1>

            <!-- Tombol Create -->
            <a href="{{ route('employees.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition">
                + Tambah Pegawai
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded-2xl shadow-lg">
            <table class="min-w-full border-collapse">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="py-3 px-4 text-left font-semibold">Nama Lengkap</th>
                        <th class="py-3 px-4 text-left font-semibold">Email</th>
                        <th class="py-3 px-4 text-left font-semibold">Nomor Telepon</th>
                        <th class="py-3 px-4 text-left font-semibold">Tanggal Lahir</th>
                        <th class="py-3 px-4 text-left font-semibold">Alamat</th>
                        <th class="py-3 px-4 text-left font-semibold">Tanggal Masuk</th>
                        <th class="py-3 px-4 text-left font-semibold">Status</th>
                        <th class="py-3 px-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($employees as $employee)
                    <tr class="border-b hover:bg-gray-50 transition duration-150">
                        <td class="py-3 px-4 text-gray-700">{{ $employee->nama_lengkap }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $employee->email }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $employee->nomor_telepon }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $employee->tanggal_lahir }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $employee->alamat }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $employee->tanggal_masuk }}</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                {{ $employee->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($employee->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center space-x-2">
                            <a href="{{ route('employees.show', $employee->id) }}"
                                class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded-lg transition">
                                Detail
                            </a>
                            <a href="{{ route('employees.edit', $employee->id) }}"
                                class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white text-sm px-3 py-1 rounded-lg transition">
                                Edit
                            </a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded-lg transition">
                                    Delete
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

</body>
</html>
