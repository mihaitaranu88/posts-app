<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id','name','username','email','address','phone','website','company'];

    protected $casts = [
        'address' => 'array',
        'company' => 'array'
    ];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function posts(){
        return $this->hasMany(Post::class, 'userId');
    }


}
