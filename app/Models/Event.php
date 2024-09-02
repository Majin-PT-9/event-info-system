<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['address_id', 'name', 'description', 'starts_at', 'ends_at', 'published'];

    protected function casts(): array
    {
        return [
            "name" => 'string',
            "address_id" => 'integer',
            'description' => 'string',
            "starts_at" => 'datetime',
            "ends_at" => 'datetime',
            "published" => 'boolean',
            "address" => Address::class,
            "users" => asCollection::class
        ];
    }

    //region relationships
    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    public function address(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
    //endregion
}
