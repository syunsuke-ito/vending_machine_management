<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Company;
use App\ProductImage;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧画面を表示する
     *
     * @return view
     */
    public function index()
    {     
        $products = Product::all();
        return view('product', ['products' => $products]);
    }

    /**
     * 商品詳細を表示する
     * @param int $id
     * @return view
     */
    public function showDetail($id)
    {
        $product = Product::find($id);

        if(is_null($product)){
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('home'));
        }

        return view('detail', ['product' => $product]);
    }

     /**
     * 商品登録画面を表示する
     * 
     * @return view
     */
    public function showCreate()
    {
        $products = Product::all();
        return view('form', ['products' => $products]);
    }

     /**
     * 商品を登録する
     * 
     * @return view
     */
    public function exeStore(Request $request) 
    {
        $this->validate($request, Product::$rules, ProductImage::$rules);
        $inputs = $request->all();
        try {
            \DB::beginTransaction();

            $products = new Product();
            $products->fill($inputs)->save();
            

            $productid = $products->id;
            $upload_image = $request->file('image');
            
            if($upload_image) {
                $path = $upload_image->store('uploads',"public");
             if($path){
                $productimage = New ProductImage();
                $productimage->fill([
                    "product_id" => $productid,
                    "file_name" => $upload_image->getClientOriginalName(),
                    "file_path" => $path
                ])->save();
             }
            }
            \DB::commit();
        }catch(\Throwable $e){
                \DB::rollback();
                abort(500);
            }
            \Session::flash('err_msg', 'ブログを登録しました');
            return redirect(route('home'));
    }

    /**
     * 商品編集を表示する
     * @param int $id
     * @return view
     */
    public function showEdit($id)
    {
        $companys = Company::all();
        $product = Product::find($id);
        return view('edit', ['product' => $product, 'companys' => $companys]);
    }

    /**
     * 商品を更新する
     * 
     * @return view
     */
    public function exeUpdate(Request $request) {
        $inputs = $request->all();
        $request->validate([
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);
        
        \DB::beginTransaction();
        try {
            $product = Product::find($inputs['id']);
            $product->fill([
                'product_name' => $inputs['product_name'],
                'company_id' => $inputs['company_id'],
                'price' => $inputs['price'],
                'stock' => $inputs['stock'],
                'comment' => $inputs['comment'],
            ]);
            $product->save();
   
            $upload_image = $request->file('image');
            if($upload_image) {
                $path = $upload_image->store('uploads',"public");
                if($path){
                $productimage = new ProductImage();
                $productimage->fill([
                    "product_id" => $inputs['id'],
                    "file_name" => $upload_image->getClientOriginalName(),
                    "file_path" => $path
                ]);
                $productimage->save();
                }
            }
            \DB::commit();
        } catch(\Throwable $e){
                \DB::rollback();
                abort(500);
            }
        return redirect(route('home'));
    }

    /**
     * 商品削除
     * @param int $id
     * @return view
     */
    public function exeDelete($id)
    {
        if(empty($id)){
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('home'));
        }
        try{
            $product = Product::find($id);
            foreach ($product['productimage'] as $image) {
                

                Storage::delete('public/'.$image['file_path']);

            }
            $product->productimage()->delete();
            $product->delete();
            
        }catch(\Throwable $e){
            abort(500);
        }
        \Session::flash('err_msg', '削除しました');
        return redirect(route('home'));
    }

    /**
     * 検索機能
     * 
     * @return view
     */
    public function serch(Request $request) {
        $keyword_product_name = $request->input('product_name');
        $keyword_company_id = $request->input('company_id');
        $query = Product::query();


        if(!empty($keyword_product_name) && empty($keyword_company_id)) {    
            $query->where('product_name','like', '%' .$keyword_product_name. '%')->get();
             }
             

        elseif (!empty($keyword_company_id) && empty($keyword_product_name)) {
            $query->where('company_id', $keyword_company_id)->get();
            }
        elseif(!empty($keyword_product_name) && !empty($keyword_company_id)){
            $query->where('company_id', $keyword_company_id)->get();
            $query->where('product_name','like', '%' .$keyword_product_name. '%')->get();
        }


            $products = $query->paginate(10);
            
        
            
        return view('product', ['products' => $products]);
        
        }


    

}
