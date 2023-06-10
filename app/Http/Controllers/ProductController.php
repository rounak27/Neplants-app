<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index( Request $request)
    {
        $filterCategorySlugs=$request->get('category');

        $categories=Category::limit(11)->get();
        $category= Category::where('slugs',$filterCategorySlugs)->first();
       if($category){
              $products=$category->products()->get();
       }
       else{
         $products=Product::all();
       }
         return view("Products.list",[
            'categories'=>$categories,
            'products'=>$products,
        ]);
    }
    public function show($slugs)
    {               

        $product=Product::where('slugs',$slugs)->first();
        return view('Products.show',[
            'product'=>$product
        ]);
    }
}

