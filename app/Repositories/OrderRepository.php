<?php


namespace App\Repositories;


use App\Helper;
use App\orders;
use App\User;
use Illuminate\Support\Facades\Hash;
use function MongoDB\BSON\toJSON;

class OrderRepository
{
    const PAGINATE_NUMBER = 10;

    public function all()
    {
        return orders::all()->paginate(self::PAGINATE_NUMBER);
    }

    public function byGuid($id)
    {
        return User::where('id', $id)->first();
    }

    public function insert($data)
    {
        $order = new  order();
        $order->guid = Helper::generateGuid();
        $order->folio = Helper::generateFolio();
        $order->total= $data->total;
        $order->items = toJSON($data->products);

        return $order->save();
    }

    public function update($data)
    {
        $order = order::where('guid', '=', $data->guid)->first();
        $order->total= $data->total;
        $order->items = toJSON($data->products);

        return $order->save();
    }

    public function delete($guid)
    {
        $order = order::where('guid', '=', $guid)->delete();


        return $order->save();
    }


}
