<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dept extends Model
{
    use HasFactory;

    protected $table = 'depts';
    protected $fillable = ['d_name', 'd_active'];


    public function getStatusAttribute(){
        return $this->d_active ? 'active':'Inactive';
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function otickets(){
        return $this->hasMany(Tickets::class, 'rdept_id', 'id');
    }

    public function intickets(){
        return $this->belongsTo(Tickets::class, 'dept_id', 'id');
    }
}
