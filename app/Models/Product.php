<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $price
 * @property int $brand_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @property int $shop_id
 * @property-read \App\Models\Brand $brand
 * @property-read \App\Models\User $shop
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShopId($value)
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUserId($value)
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'brand_id'];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }
    public function shop() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
