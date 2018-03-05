<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

    public $timestamps = false;

}
