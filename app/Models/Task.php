<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**  
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    /**   
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}