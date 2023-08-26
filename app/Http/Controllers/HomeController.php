<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories=Category::limit(11)->get();
        $Slidercategories=Category::limit(5)->get();
        $products=Product::limit(6)-> orderBy('created_at','desc')->get();
       // dd($products);
        return view("home",[
            'categories'=>$categories,
            'slidercategories'=>$Slidercategories,
            'products'=>$products
        ]);
        
    }
}
