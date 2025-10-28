<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'departemen_id',
        'jabatan_id',
        'status',
    ];

    public function salaries(){
        return $this->hasMany(Salary::class, 'karyawan_id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'departemen_id');
    }

    public function attendances(){
        return $this->hasMany(Attendance::class, 'employee_id');
    }

    public function position(){
        return $this->belongsTo(Position::class, 'jabatan_id');
    }
}
