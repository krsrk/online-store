<?php


namespace App\Repositories;


use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    const PAGINATE_NUMBER = 10;

    public function all()
    {
        return User::where('status','=','1')->paginate(self::PAGINATE_NUMBER);
    }

    public function byGuid($id)
    {
        return User::where('id', $id)->first();
    }

    public function insert($data)
    {
        $user = new User();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = Hash::make($data->password);
        $user->rol_id = $data->rol_id;
        $user->ip = $_SERVER['REMOTE_ADDR'];
        $user->status = $data->status;

        return $user->save();
    }

    public function update($data)
    {
        $user = User::where('id', '=', $data->id)->first();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->rol_id = $data->rol_id;
        $user->ip = $_SERVER['REMOTE_ADDR'];
        $user->status = $data->status;

        return $user->save();
    }

    public function delete($id)
    {
        $user = User::where('id', '=', $id)->first();
        $user->status = '3';

        return $user->save();
    }

    public function suspend($id)
    {
        $user = User::where('id','=', $id)->first();
        $user->status= '2';
        return $user->save();


    }
}
