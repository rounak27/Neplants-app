<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CrudTrait;
    
    use HasFactory;
    protected $guarded=[];
    public function products(){
        return $this->belongsToMany(Product::class);
    }
    public function setImageAttribute($value)
    {
        $this->attributes['image']=$value->store('public');
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name']=$value;
        $this->attributes['slugs']=str()->slug($this->name);
    }
}
