<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Request as RequestModel;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;

class ProfileController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showRequests(RequestModel $request)
    {
        /** @var User $user */
        $user = auth()->user();




        if (!$user->isShop()) {
            $user->load('requests.user');
            $requests = $user->requests;
        } else {
            $requests = RequestModel
                ::with('user')->join('products', function($join) {
                    $join->on('requests.name', '=', 'products.name')
                        ->on('requests.brand_id','=','products.brand_id')
                        ->on('products.price', '>=', 'requests.price_min')
                        ->on('products.price', '<=', 'requests.price_max');
                })
                ->distinct()
                ->where('products.user_id', '=', $user->id)
                ->select('requests.*', 'products.id as productId')
                ->get();
        }



        return Inertia::render('Profile/Request', [
            'requests' => $requests,
        ]);
    }


    public function showProducts(RequestModel $request)
    {
        /** @var User $user */
        $user = auth()->user();
        if (!$user->isShop()) {
            abort(403);
        }
        $user->load('products.brand');
        return Inertia::render('Profile/Products', [
            'products' => $user->products,
        ]);
    }

    public function showProduct(Product $product, RequestModel $request)
    {
        if (auth()->user()->id !== $product->user_id) {
            abort(403);
        }

        $brands = Brand::all();
        return Inertia::render('Profile/Product', [
            'product' => $product,
            'brands' => $brands,
        ]);
    }

    public function createProduct(RequestModel $request) {
        if (!auth()->user()->isShop()) {
            abort(403);
        }

        $brands = Brand::all();
        return Inertia::render('Profile/ProductCreate', [
            'brands' => $brands,
        ]);
    }
    public function deleteRequest(RequestModel $request) {
        $request->delete();
        return redirect('profile/request')->with('success_message', 'Запрос удален');
    }

    public function onCreateProduct(Request $request) {
        /** @var User $user */
        $user = auth()->user();
        $this->validate($request, [
            'name' => 'required',
            'price' => 'numeric|required',
            'brand_id' => 'required',
        ]);

        $product = new Product($request->all());
        $product->shop()->associate($user);
        $product->save();

        $request->session()->flash('success_message', 'Запчасть создана');
        return redirect('/profile/products');
    }
    public function editProduct(Request $request, Product $product ) {

        if (auth()->user()->id !== $product->user_id) {
            abort(403);
        }

        $this->validate($request, [
           'name' => 'required',
           'brand_id' => 'required',
           'price' => 'numeric|required',
        ]);
        $product->fill($request->all());
        $product->save();
        $request->session()->flash('success_message','Запчасть изменена');
        return redirect('profile/products');
    }
    public function deleteProduct(Request $request, Product $product) {

        if (auth()->user()->id !== $product->user_id) {
            abort(403);
        }

        $product->delete();
        return redirect('profile/products')->with('success_message', 'Запчасть удалена');
    }
}
