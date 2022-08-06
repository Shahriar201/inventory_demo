<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public $model;
    public $viewDirectory = 'product::product';
    public $route = 'product';
    public $dataName = 'Product';

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
        $products = $this->model->all();
        
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Renderable
    {
        $category = Category::pluck('name', 'id');

        return view('backend.product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function fillableAttributes($request): array
    {
        return $request->only(
            'category_id',
            'name',
            'price',
            'image',
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        $code = rand(1000, 9999);
        
        try {
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->code = $code;
            $product->price = $request->price;

            // $this->model->create([
            //     'category_id' => $request->category_id,
            //     'name' => $request->name,
            //     'slug' => Str::slug($request->name),
            //     'code' => Str::rand(1000, 9999),
            //     'price' => $request->price,
            // ]);

            if ($request->file('image')) {
                    $file = $request->file('image');
                    $fileName = date('YmdHi').$file->getClientOriginalName();
                    $file->move('public/uploads/product_images/', $fileName);
                    $product['image'] = $fileName;
                }
            $product->save();

            return redirect()->route('product.index')->with('success', $this->dataName . ' Added Successfully!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
