<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoOrder extends Model
{
    protected $table = "info_order";

    protected $primaryKey = 'info_order_id';
    protected $guarded = [];
}
