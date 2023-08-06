<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    use HasFactory;

    protected $table = 'depts';
    protected $fillable = ['d_name', 'd_active'];


    public function getStatusAttribute(){
        return $this->d_active ? 'active':'Inactive';
    }
}
