<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $guarded=[];
    public function formatted_amount()
    {
        return'Rs.'.  $this->price;
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
   public function setPriceAttribute($value)
   {
       $this->attributes['price']= $value*100;//accessor
   }
    public function getPriceAttribute($value)
    {
         return $value/100;//mutator
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name']=$value;
        $this->attributes['slugs']=str()->slug($this->name);
    }
}
