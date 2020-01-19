<?php
namespace App\Repositories;

use App\Product;
use App\Helper;
use Illuminate\Support\Facades\Auth;


class ProductRepository
{
    const PAGINATE_NUMBER = 10;

    public function all()
    {
        return Product::where('status', '<>', 'deleted')->paginate(self::PAGINATE_NUMBER);
    }

    public function byGuid($guid)
    {
        return Product::where('product_guid', $guid)->first();
    }

    public function insert($data)
    {
        $product = new Product();
        $product->product_guid = Helper::generateGuid();
        $product->product_name = $data->product_name;
        $product->id_user_maker = Auth::id();
        $product->image = $data->image;
        $product->stock = $data->stock;
        $product->price = $data->price;
        $product->is_special = $data->is_special;
        $product->description = $data->description;
        $product->video = $data->video;

        return $product->save();
    }

    public function update($data)
    {
        $product = Product::where('product_guid', '=', $data->guid)->first();
        $product->product_name = $data->product_name;
        //$product->image = $data->image;
        $product->stock = $data->stock;
        $product->price = $data->price;
        $product->is_special = $data->is_special;
        $product->description = $data->description;
        $product->video = $data->video;

        return $product->save();
    }

    public function delete($id)
    {
        $product = Product::where('product_guid', '=', $id)->first();
        $product->status = 'deleted';

        return $product->save();
    }

    public function publish($id)
    {
        $product = Product::where('product_guid','=', $id)->first();
        $product->status= 'published';
        $product->published_at = date('Y-m-d H:i:s');
        $product->id_user_publisher=Auth::id();
        return $product->save();


    }

    public function image($data)
    {
        $product = Product::where('product_guid','=', $data->guid)->first();
        $product->image=$data->image;
        return $product->save();
    }
}
