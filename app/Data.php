<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'data';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'lat', 'lng', 'radius', 'time', 'source', 'device_id'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

}
