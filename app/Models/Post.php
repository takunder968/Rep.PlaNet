<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

   protected $fillable = [
        'title',
        'body' ,
        'user_id'

        ];
    
    public function getPaginateByLimit(int $limit_count = 5)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
    // Userに対するリレーション

    //「1対多」の関係なので単数系に
    public function user()
    {
    return $this->belongsTo(User::class);
    }
    
}
