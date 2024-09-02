<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name', 'street', 'house_number', 'house_number_addition', 'zip_code', 'city', 'country_code', 'phone', 'email', 'website'];
    protected function casts(): array
    {
        return [
            "name"                  => 'string',
            "street"                => 'string',
            'house_number'          => 'integer',
            "house_number_addition" => 'string',
            "zip_code"              => 'string',
            "city"                  => 'string',
            "country_code"          => 'string',
            "phone"                 => 'string',
            "email"                 => 'string',
            "website"               => 'string',
            "events"                => asCollection::class,
        ];
    }
    //region relationships
    public function events(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Event::class);
    }
    //endregion
}
