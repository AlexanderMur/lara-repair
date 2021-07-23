<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Request
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Request newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Request newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Request query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $price_min
 * @property int $price_max
 * @property string $brand
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request wherePriceMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request wherePriceMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereUpdatedAt($value)
 * @property int $user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereUserId($value)
 * @property string $brand_id
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereBrandId($value)
 */
class Request extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'brand_id', 'price_min', 'price_max'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

}
