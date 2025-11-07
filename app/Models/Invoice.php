<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'id_number',
        'address',
        'phone',
        'start_date',
        'end_date',
        'plate_number',
        'motor_type',
        'helmets',
        'raincoat',
        'phone_holder',
        'disk_lock',
        'delivery_place',
        'pickup_place',
        'guarantee',
        'rental_fee',
        'down_payment',
        'other_notes',
        'pdf_path',
        'cek_lampu_depan',
        'cek_lampu_belakang',
        'cek_lampu_signal_kanan',
        'cek_lampu_signal_kiri',
        'cek_kaca_spion',
        'fuel_level',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'raincoat' => 'boolean',
        'phone_holder' => 'boolean',
        'disk_lock' => 'boolean',
        'cek_lampu_depan' => 'boolean',
        'cek_lampu_belakang' => 'boolean',
        'cek_lampu_signal_kanan' => 'boolean',
        'cek_lampu_signal_kiri' => 'boolean',
        'cek_kaca_spion' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
