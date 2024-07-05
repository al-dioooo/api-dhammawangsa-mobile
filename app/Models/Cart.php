<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',

        'product_model_id',
        'product_model_name',
        'product_unit_id',
        'product_unit_name',

        'quantity',
        'price'
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

        $query->when($filters['user_id'] ?? null, function ($query, $value) use ($table) {
            $query->where("{$table}.user_id", 'like', '%' . $value . '%');
        });
    }
}
