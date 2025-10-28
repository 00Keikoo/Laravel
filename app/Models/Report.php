namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'hadir',
        'izin',
        'sakit',
        'alpa',
        'total_hari',
        'bulan',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
