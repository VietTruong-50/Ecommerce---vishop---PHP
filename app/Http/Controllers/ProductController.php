<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recursive;
use App\Http\Requests\ProductAddRequest;
use App\Product;
use App\ProductImage;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\StorageImageTrait;

class ProductController extends Controller
{
    use StorageImageTrait;

    private $product;
    private $category;
    private $productImage;

    public function __construct(Product $product, Category $category, ProductImage $productImage)
    {
        $this->product = $product;
        $this->category = $category;
        $this->productImage = $productImage;
    }

    public function index()
    {
        $products = $this->product->latest()->paginate(5);
        return view('admin.product.index', compact('products'));
    }

    public function getCategory($parent_id): string
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        return $recursive->categoryRecursive($parent_id);
    }

    public function create()
    {
        $htmlOption = $this->getCategory('');
        return view('admin.product.add', compact('htmlOption'));
    }

    public function store(ProductAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];
            $imageUpload = $this->storageTraitUpload($request, 'feature_img_path', 'product');
            if (!empty($imageUpload)) {
                $data['feature_img_path'] = $imageUpload['file_path'];
                $data['feature_img_name'] = $imageUpload['file_name'];
            }
            $product = $this->product->create($data);
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $imageItem) {
                    $dataProductImageDetails = $this->storageTraitUploadMultiple($imageItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetails['file_path'],
                        'image_name' => $dataProductImageDetails['file_name']
                    ]);
                }
            }

            if(!empty($request->tags)){
                foreach ($request->tags as $tagItem) {
                    $tagInstance = Tag::firstOrCreate([
                        'name' => $tagItem
                    ]);
                    $tagIds[] = $tagInstance->id;
                }
            }

            $product->tags()->attach($tagIds);
            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
        }
    }

    public function edit($id){
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.product.edit', compact('product', 'htmlOption'));
    }

    public function update($id, Request $request){
        try {
            DB::beginTransaction();
            $dataUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,

            ];

            $imageUpload = $this->storageTraitUpload($request, 'feature_img_path', 'product');

            if (!empty($imageUpload)) {
                $dataUpdate['feature_img_path'] = $imageUpload['file_path'];
                $dataUpdate['feature_img_name'] = $imageUpload['file_name'];
            }

            $this->product->find($id)->update($dataUpdate);

            $product = $this->product->find($id);

            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $imageItem) {
                    $dataProductImageDetails = $this->storageTraitUploadMultiple($imageItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetails['file_path'],
                        'image_name' => $dataProductImageDetails['file_name']
                    ]);
                }
            }

            if(!empty($request->tags)){
                foreach ($request->tags as $tagItem) {
                    $tagInstance = Tag::firstOrCreate([
                        'name' => $tagItem
                    ]);
                    $tagIds[] = $tagInstance->id;
                }
            }

            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
            return 'Error';
        }
    }

    public function delete($id){
        try{
            $this->product->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        }catch (\Exception $exception){
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }

}
