<?php

namespace App\Models\Migrasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reviewMigrasi extends Model
{
    use HasFactory;

    protected $table = "reviews";
    public $timestamps = false;

    // Añade este método para especificar la factory
    protected static function newFactory()
    {
        return \Database\Factories\Migrasi\ReviewMigrasiFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(userMigrasi::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(restaurantMigrasi::class);
    }
}
