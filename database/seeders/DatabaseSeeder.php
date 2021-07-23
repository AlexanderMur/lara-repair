<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** @var Brand[] $brands */
        $brands = [];
        /** @var Product[] $products */
        $products = [];
        /** @var Request[] $requests */
        $requests = [];
        /** @var User[] $users */
        $users = [];

        /** @var User[] $shops */
        $shops = [];

        $brand = new Brand();
        $brand->name = 'BMW';
        $brand->save();
        $brands['bmw'] = $brand;

        $brand = new Brand();
        $brand->name = 'Kia';
        $brand->save();
        $brands['kia'] = $brand;

        $brand = new Brand();
        $brand->name = 'Lexus';
        $brand->save();
        $brands['lexus'] = $brand;

        $user = new User();
        $user->name = 'Василий';
        $user->password = Hash::make('Asdfg123');
        $user->email = 'user@gmail.com';
        $user->save();

        $shop = new User();
        $shop->is_shop = true;
        $shop->name = 'AvtoParts';
        $shop->email = 'admin@avtoparts.ru';
        $shop->password = Hash::make('Asdfg123');
        $shop->save();
        $shops['AvtoParts'] = $shop;

        $shop = new User();
        $shop->is_shop = true;
        $shop->name = 'parts4you';
        $shop->email = 'admin@parts4you.ru';
        $shop->password = Hash::make('Asdfg123');
        $shop->save();
        $shops['Parts4you'] = $shop;

        $shop = new User();
        $shop->is_shop = true;
        $shop->name = 'avtochast';
        $shop->email = 'admin@avtochast.ru';
        $shop->password = Hash::make('Asdfg123');
        $shop->save();
        $shops['AvtoChasti'] = $shop;


        $product = new Product();
        $product->name = 'Cтоп-сигнал BMW X6';
        $product->price = 1500;
        $product->brand()->associate($brands['bmw']);
        $product->shop()->associate($shops['AvtoChasti']);
        $product->save();
        $products[] = $product;

        $product = new Product();
        $product->name = 'Cтоп-сигнал BMW X6';
        $product->price = 2000;
        $product->brand()->associate($brands['bmw']);
        $product->shop()->associate($shops['AvtoParts']);
        $product->save();
        $products[] = $product;

        $product = new Product();
        $product->name = 'Cтоп-сигнал BMW X6';
        $product->price = 3000;
        $product->brand()->associate($brands['bmw']);
        $product->shop()->associate($shops['Parts4you']);
        $product->save();
        $products[] = $product;



        $product = new Product();
        $product->name = 'Подлокотник';
        $product->price = 1500;
        $product->brand()->associate($brands['lexus']);
        $product->shop()->associate($shops['AvtoChasti']);
        $product->save();
        $products[] = $product;

        $product = new Product();
        $product->name = 'Подлокотник';
        $product->price = 5000;
        $product->brand()->associate($brands['lexus']);
        $product->shop()->associate($shops['AvtoParts']);
        $product->save();
        $products[] = $product;

        $product = new Product();
        $product->name = 'Подлокотник';
        $product->price = 5000;
        $product->brand()->associate($brands['lexus']);
        $product->shop()->associate($shops['Parts4you']);
        $product->save();
        $products[] = $product;

        $product = new Product();
        $product->name = 'Руль';
        $product->price = 1500;
        $product->brand()->associate($brands['kia']);
        $product->shop()->associate($shops['AvtoChasti']);
        $product->save();
        $products[] = $product;

        $product = new Product();
        $product->name = 'Руль';
        $product->price = 4000;
        $product->brand()->associate($brands['kia']);
        $product->shop()->associate($shops['AvtoParts']);
        $product->save();
        $products[] = $product;

        $product = new Product();
        $product->name = 'Руль';
        $product->price = 15000;
        $product->brand()->associate($brands['kia']);
        $product->shop()->associate($shops['Parts4you']);
        $product->save();
        $products[] = $product;



        $request = new Request();
        $request->price_min = 1999;
        $request->price_max = 3000;
        $request->name = 'Cтоп-сигнал BMW X6';
        $request->user()->associate($user);
        $request->brand()->associate($brands['bmw']);
        $request->save();

        $request = new Request();
        $request->price_min = 4999;
        $request->price_max = 10000;
        $request->name = 'Подлокотник';
        $request->user()->associate($user);
        $request->brand()->associate($brands['lexus']);
        $request->save();


    }
}
