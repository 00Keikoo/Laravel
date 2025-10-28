{{-- resources/views/salaries/create.blade.php --}}

@extends('master')
@section('content')
<div class="max-w-lg mx-auto bg-white shadow-md rounded-xl p-6 mt-6">
  <h2 class="text-xl font-bold mb-4">Tambah Data Gaji</h2>

  <form action="{{ route('salaries.store') }}" method="POST" id="form-gaji">
    @csrf

    <div class="mb-4">
      <label class="block mb-2 font-medium">Pegawai</label>
      <select name="karyawan_id" id="karyawan_id" class="w-full border rounded p-2" required>
    <option value="">-- Pilih Pegawai --</option>
    @foreach ($employees as $emp)
        <option value="{{ $emp->id }}"
                data-gaji="{{ $emp->position?->gaji_pokok ?? 0 }}">
            {{ $emp->nama_lengkap }} 
            @if($emp->position)
                ({{ $emp->position->nama_jabatan }})
            @else
                <span class="text-red-500">(Tanpa Jabatan!)</span>
            @endif
        </option>
          @endforeach
      </select> 
    </div>

    <div class="mb-4">
      <label class="block mb-2 font-medium">Bulan</label>
      <input type="text" name="bulan" class="w-full border rounded p-2" 
             placeholder="Contoh: Oktober 2025" required>
    </div>

    <div class="mb-4">
      <label class="block mb-2 font-medium">Gaji Pokok</label>
      <input type="number" name="gaji_pokok" id="gaji_pokok" class="w-full border rounded p-2" 
             step="0.01" required>
    </div>

    <div class="mb-4">
      <label class="block mb-2 font-medium">Tunjangan</label>
      <input type="number" name="tunjangan" id="tunjangan" class="w-full border rounded p-2" 
             step="0.01" value="0">
    </div>

    <div class="mb-4">
      <label class="block mb-2 font-medium">Potongan</label>
      <input type="number" name="potongan" id="potongan" class="w-full border rounded p-2" 
             step="0.01" value="0">
    </div>

    <div class="mb-4">
      <label class="block mb-2 font-medium">Total Gaji</label>
      <input type="number" name="total_gaji" id="total_gaji" class="w-full border rounded p-2 bg-gray-100" 
             readonly>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
      Simpan
    </button>
  </form>

  <script>
    const selectKaryawan = document.getElementById('karyawan_id');
    const inputGajiPokok = document.getElementById('gaji_pokok');
    const inputTunjangan = document.getElementById('tunjangan');
    const inputPotongan = document.getElementById('potongan');
    const inputTotal = document.getElementById('total_gaji');

    // Update gaji pokok saat pilih karyawan
    selectKaryawan.addEventListener('change', function() {
      const gajiDefault = this.selectedOptions[0].getAttribute('data-gaji') || 0;
      inputGajiPokok.value = gajiDefault;
      hitungTotal();
    });

    // Hitung total otomatis
    function hitungTotal() {
      const pokok = parseFloat(inputGajiPokok.value) || 0;
      const tunjangan = parseFloat(inputTunjangan.value) || 0;
      const potongan = parseFloat(inputPotongan.value) || 0;
      inputTotal.value = pokok + tunjangan - potongan;
    }

    // Event listener untuk perubahan input
    [inputGajiPokok, inputTunjangan, inputPotongan].forEach(el => {
      el.addEventListener('input', hitungTotal);
    });

    // Trigger saat halaman load (jika ada default)
    hitungTotal();
  </script>
</div>
@endsection