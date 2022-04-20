<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = [
        'category_name',
        'description',
        'parent_name',
        'status',
        'category_image',
    ];

    public function childs(){
        return $this->hasmany(Category::class, 'parent_id', 'id');
    }
}
