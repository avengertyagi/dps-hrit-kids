<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'state_id',
        'name',
        'status'
    ];

    /**
     * The state that this city belongs to.
     *
     * @return BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
