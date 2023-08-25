<?php

namespace App\Models;

use App\Models\Status;
use App\Models\Priority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['title','rdept_id','ruser_id','category_id','subcategory_id','description','status_id','priority_id','dept_id','user_id', 'attachedFiles' ];

    protected $data = ['create_at', 'updated_at'];

    // public function getFileCountAttribute(){
    //    return $this->
    // }

    public function getHasFileAttribute(){
        return trim($this->attachedFiles) != '';
    }

    public function getFilesListAttribute(){
        $filesList = explode('#',trim($this->attachedFiles));
        array_pop($filesList);
        $filesList = collect($filesList);
        return $filesList;
    }

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

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function priority(){
        return $this->belongsTo(Priority::class);
    }

    public function usersonit(){
        return $this->belongsToMany(User::class, 'staffs_on_ticket' )->withTimestamps()->withPivot('ismain','status');
    }
    
    public function getMainuserAttribute(){
        return $this->usersonit()->where('ismain',true)->first();
    }

    





}
