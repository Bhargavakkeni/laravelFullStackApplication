<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    use HasFactory;

    protected $table = 'Hosts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'gender'
    ];

    public function projects(){
        return $this->hasMany('App\Models\Project', 'user_id');
    }

}
