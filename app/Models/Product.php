<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{

    use CrudTrait;
    use HasFactory;
    use InteractsWithMedia;
    protected $guarded=[];
    protected $casts=[
        'images'=>'array'
    ];
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
    public function setImagesAttribute($value)
    {
        $this->uploadMultipleFilesToDisk($value,'images','public','products');
    }
}
