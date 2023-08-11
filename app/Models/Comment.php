<?php

namespace App\Models;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ticket_id', 'commemttext', 'filesattached'];

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getHasFileAttribute(){
        return trim($this->filesattached) != '';
    }

    public function getFilesListAttribute(){
        $filesList = explode('#',trim($this->filesattached));
        array_pop($filesList);
        $filesList = collect($filesList);
        return $filesList;
    }
}
