<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductDBQueryController extends Controller
{
    public $model;
    public $viewDirectory = 'productQuery::product-query';
    public $route = 'productQuery';
    public $dataName = 'ProductQuery';

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Renderable
    {
        $products = DB::table('products as product')
                        ->select('product.id', 'product.name', 'product.slug', 'product.code', 'product.total_stock', 'product.price', 'product.image', 'category.name as category_id')
                        ->leftJoin('categories as category', 'product.category_id', 'category.id')
                        ->get();

        return view('backend.product-query.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Renderable
    {
        $category = DB::table('categories')->pluck('name', 'id');

        return view('backend.product-query.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): object
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        $code = rand(1000, 9999);

        try {
            if ($request->file('image')) {
                    $file = $request->file('image');
                    $fileName = date('YmdHi').$file->getClientOriginalName();
                    $file->move('uploads/product_images/', $fileName);
                    $product['image'] = $fileName;
                }
            
            $product = DB::table('products')->insert([
                            'category_id' => $request->category_id,
                            'name' => $request->name,
                            'slug' =>  Str::slug($request->name),
                            'code' =>  $code,
                            'price' =>  $request->price,
                            'image' =>  $fileName,
            ]);

            return redirect()->route('productQuery.index')->with('success', $this->dataName . ' Added Successfully!');
        } catch (\Exception $e) {
            Log::error($e);
            dd($e->getMessage());
            return \redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('products')->find($id);

        if(file_exists('uploads/product_images/' . $product->image) AND ! empty($product->image)) {
            unlink('uploads/product_images/' . $product->image);
        }

        $product = DB::table('products')->where('id', $id)->delete();

        return redirect()->route('productQuery.index')->with('success', $this->dataName . ' Deleted successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): Renderable
    {
        // $product = $this->model->findOrFail($id);
        $product = DB::table('products')->find($id);
        $category = DB::table('categories')->pluck('name', 'id');

        return view('backend.product-query.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): object
    {
        $product =  DB::table('products')->find($id);

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        try {
            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('uploads/product_images/'.$product->image));
                $fileName = date('YmdHi').$file->getClientOriginalName();
                $file->move('uploads/product_images/', $fileName);
                $product['image'] = $fileName;
            }
            
            $product = DB::table('products')->update([
                            'category_id' => $request->category_id,
                            'name' => $request->name,
                            'price' =>  $request->price,
                            'image' =>  $fileName,
            ]);

            return redirect()->route('productQuery.index')->with('success', $this->dataName . ' Added Successfully!');
        } catch (\Exception $e) {
            Log::error($e);
            dd($e->getMessage());
            return \redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
