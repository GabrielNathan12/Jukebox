<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'table_task';
    protected $fillable = ['title', 'description', 'user_id'];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
