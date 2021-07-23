<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;

class RequestController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function show() {
        $brands = Brand::all();
        return Inertia::render('Request', [
            'brands' => $brands,
        ]);
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function onSubmit(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'price_min' => 'numeric',
            'price_max' => 'numeric',
            'brand_id' => 'numeric',
        ]);

        $newRequest = new \App\Models\Request($request->all());
        $newRequest->user()->associate($request->user());
        $newRequest->save();
        return redirect('/profile/request')->with('Запрос опубликован');
    }
}
