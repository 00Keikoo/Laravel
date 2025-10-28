{{-- resources/views/salaries/edit.blade.php --}}

@extends('master')
@section('content')
<div class="max-w-lg mx-auto bg-white shadow-md rounded-xl p-6 mt-6">
  <h2 class="text-xl font-bold mb-4 text-center">Edit Data Gaji</h2>

  <form action="{{ route('salaries.update', $salary->id) }}" method="POST" id="form-gaji">
    @csrf
    @method('PUT')

    <div class="mb-4">
      <label class="block mb-2 font-medium">Pegawai</label>
      <select name="karyawan_id" id="karyawan_id" class="w-full border rounded p-2" required>
        <option value="">-- Pilih Pegawai --</option>
        @foreach ($employees as $emp)
          <option value="{{ $emp->id }}"
                  data-gaji="{{ $emp->position?->gaji_pokok ?? 0 }}"
                  {{ $salary->karyawan_id == $emp->id ? 'selected' : '' }}>
            {{ $emp->nama_lengkap }} ({{ $emp->position?->nama_jabatan ?? 'Tanpa Jabatan' }})
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-4">
      <label class="block mb-2 font-medium">Bulan</label>
      <input type="text" name="bulan" class="w-full border rounded p-2" 
             value="{{ old('bulan', $salary->bulan) }}" required>
    </div>

    <div class="mb-4">
      <label class="block mb-2 font-medium">Gaji Pokok</label>
      <input type="number" name="gaji_pokok" id="gaji_pokok" class="w-full border rounded p-2" 
             value="{{ old('gaji_pokok', $salary->gaji_pokok) }}" step="0.01" required>
    </div>

    <div class="mb-4">
      <label class="block mb-2 font-medium">Tunjangan</label>
      <input type="number" name="tunjangan" id="tunjangan" class="w-full border rounded p-2" 
             value="{{ old('tunjangan', $salary->tunjangan) }}" step="0.01">
    </div>

    <div class="mb-4">
      <label class="block mb-2 font-medium">Potongan</label>
      <input type="number" name="potongan" id="potongan" class="w-full border rounded p-2" 
             value="{{ old('potongan', $salary->potongan) }}" step="0.01">
    </div>

    <div class="mb-4">
      <label class="block mb-2 font-medium">Total Gaji (otomatis)</label>
      <input type="number" id="total_gaji" class="w-full border rounded p-2 bg-gray-100" 
             value="{{ old('total_gaji', $salary->total_gaji) }}" readonly>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
      Simpan Perubahan
    </button>
  </form>

  <script>
    const selectKaryawan = document.getElementById('karyawan_id');
    const inputGajiPokok = document.getElementById('gaji_pokok');
    const inputTunjangan = document.getElementById('tunjangan');
    const inputPotongan = document.getElementById('potongan');
    const inputTotal = document.getElementById('total_gaji');

    function hitungTotal() {
      const pokok = parseFloat(inputGajiPokok.value) || 0;
      const tunjangan = parseFloat(inputTunjangan.value) || 0;
      const potongan = parseFloat(inputPotongan.value) || 0;
      inputTotal.value = pokok + tunjangan - potongan;
    }

    // Update gaji pokok jika ganti karyawan (tapi jangan override jika sudah diisi manual)
    selectKaryawan.addEventListener('change', function() {
      const gajiDefault = this.selectedOptions[0].getAttribute('data-gaji') || 0;
      // Hanya isi jika gaji_pokok masih kosong atau sesuai default sebelumnya
      if (!inputGajiPokok.value || inputGajiPokok.value == gajiDefault) {
        inputGajiPokok.value = gajiDefault;
      }
      hitungTotal();
    });

    // Hitung saat input berubah
    [inputGajiPokok, inputTunjangan, inputPotongan].forEach(el => {
      el.addEventListener('input', hitungTotal);
    });

    // Jalankan saat load
    document.addEventListener('DOMContentLoaded', hitungTotal);
  </script>
</div>
@endsection