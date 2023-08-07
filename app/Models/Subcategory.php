<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'status'];

    public function getStatusWordAttribute(){
        return $this->status ? 'Active' : 'Inactive';
    }
}
