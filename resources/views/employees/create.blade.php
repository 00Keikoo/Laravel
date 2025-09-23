<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Form Pegawai</h1>
    <form method="POST" action="{{ route('employees.store') }}">
        @csrf
        <div>
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap"/>
            @error('nama_lengkap')
            {{ $message }}
            @enderror
        </div>


        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"/>
            @error('email')
            {{ $message }}
            @enderror
        </div>

        <div>
            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="text" id="nomor_telepon" name="nomor_telepon"/>
            @error('nomor_telepon')
            {{ $message }}
            @enderror
        </div>

        <div>
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir"/>
            @error('tanggal_lahir')
            {{ $message }}
            @enderror
        </div>

        <div>
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat"/>
            @error('alamat')
            {{ $message }}
            @enderror
        </div>

        <div>
            <label for="tanggal_masuk">Tanggal Masuk:</label>
            <input type="date" id="tanggal_masuk" name="tanggal_masuk"/>
            @error('tanggal_masuk')
            {{ $message }}
            @enderror
        </div>

        <div>
            <label for="status">Status:</label>
            <select type="status" id="status" required name="status">
                <option value="aktif selected">Akftif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
            @error('status')
            {{ $message }}
            @enderror
        </div>

        <div>
            <button type="submit">Submit</button>
        </div>

    </form>
</body>
</html>