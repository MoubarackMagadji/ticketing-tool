<?php

namespace App\Models;

use App\Models\Dept;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function getStatusWordAttribute(){
        return $this->status ? 'Active' : 'Inactive';
    }

    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }
    public function depts(){
        return $this->belongsToMany(Dept::class);
    }

    public function hasDept($dept){
        return in_array($dept, $this->depts->pluck('id')->toArray());
    }
}
