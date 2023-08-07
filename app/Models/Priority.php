<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sla', 'code'];

    public function getStatusWordAttribute(){
        return $this->status ? 'Active' : 'Inactive';
    }
}
