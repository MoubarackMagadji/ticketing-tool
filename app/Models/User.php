<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'isadmin',
        'level',
        'staffID',
        'username',
        'password',
        'dept_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comments(){
        return $this->belongsTo(Comment::class);
    }

    public function users(){
        return $this->belongsTo(Dept::class);
    }

    public function linkstotickets(){
        return $this->belongsToMany(Ticket::class, 'staffs_on_ticket')->withTimestamps()->withPivot('ismain','status');;
    }

    
    // public function ismainonticket(){
    //     return $this->linkstotickets()/* ->where('staffs_on_ticket.user_id',$this->id) */;
    //     // ->whereismain(true);
        
    // }

    // public function isactiveonticket(){
    //     return $this->linkstotickets()/* ->where('staffs_on_ticket.user_id',$this->id) */; 
    //     // ->where('status',false)   
    // }
    
}
