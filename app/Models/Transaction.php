<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'customer_phone',
        'customer_name',
        'customer_email',
        'subtotal',
        'discount',
        'grand_total',
        'status'
    ];

    /**
     * Resource filter function.
     *
     * @param  mixed  $query
     * @param  array  $filters
     * @return mixed $query
     */
    public function scopeFilter($query, array $filters)
    {
        $table = $this->getTable();

        $query->when($filters['customer_id'] ?? null, function ($query, $value) use ($table) {
            $query->where("{$table}.customer_id", $value);
        })->when($filters['status'] ?? null, function ($query, $value) use ($table) {
            $query->where("{$table}.status", 'like', '%' . $value . '%');
        });
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
