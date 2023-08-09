<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'status'];

    public function getStatusWordAttribute(){
        return $this->status ? 'Active' : 'Inactive';
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
