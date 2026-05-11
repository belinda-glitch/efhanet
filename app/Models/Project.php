<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'user_id',
        'kecamatan_pontianak',
        'budget_awal',
        'deadline',
        'status_k3',
        'service_type',
        'technical_progress',
        'daily_toolbox_status',
        'work_status',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function documentations()
    {
        return $this->hasMany(ProjectDocumentation::class);
    }

    /**
     * Menghitung total pengeluaran riil
     */
    public function getTotalExpensesAttribute()
    {
        return $this->expenses()->sum('jumlah_nominal');
    }

    /**
     * Menghitung varians biaya (selisih budget vs realisasi)
     */
    public function getCostVarianceAttribute()
    {
        return $this->budget_awal - $this->total_expenses;
    }

    /**
     * Menghitung persentase efisiensi (persentase budget terpakai)
     */
    public function getEfficiencyPercentageAttribute()
    {
        if ($this->budget_awal <= 0) return 0;
        return ($this->total_expenses / $this->budget_awal) * 100;
    }
}
