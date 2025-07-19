<?php

namespace App\Models\Migrasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transactionMigrasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "transactions";
    protected $primaryKey = "id";
    protected $fillable = [
        'user_id',
        'restaurant_id',
        'reservation_id',
        'payment_amount',
        'payment_date_at'
    ];

    // Añade este método
    protected static function newFactory()
    {
        return \Database\Factories\Migrasi\TransactionMigrasiFactory::new();
    }

    public function reservation()
    {
        return $this->hasOne(reservationMigrasi::class,"id","reservation_id");
    }
}
