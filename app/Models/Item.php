<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Type;
use App\Models\Technology;
use App\Models\Framework;



class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'git_link',
        'project_link',
        'repo_name',
        'date',
        'description',
        'slug',
        'type_id',
        'img_path',
        'original_img_name'
    ];

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    public function frameworks(){
        return $this->belongsToMany(Framework::class);
    }
}
