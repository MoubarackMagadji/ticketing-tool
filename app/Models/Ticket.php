<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['title','rdept_id','ruser_id','category_id','subcategory_id','description','status_id','priority_id','dept_id','user_id', 'attachedFiles' ];

    protected $data = ['create_at', 'updated_at'];

    // public function getFileCountAttribute(){
    //    return $this->
    // }

    public function rdept(){
        return $this->belongsTo(Dept::class, 'rdept_id');
    }

    public function adept(){
        return $this->belongsTo(Dept::class, 'dept_id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function Subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function ruser(){
        return $this->belongsTo(User::class, 'ruser_id');
    }

    public function luser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }



}
