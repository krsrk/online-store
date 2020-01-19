<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Repositories\UserRepository;
class UserController extends Controller
{

    protected $repository;

    public function __construct()
    {
        $this->middleware('auth');
        $this->repository = new UserRepository();
    }




    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('dashboard.users.userIndex');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->repository->insert($request);

        return response()->json('Producto creado con exito!', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return void
     */
    public function show(Request $request)
    {
        $data = $this->repository->all();
        return response()->json($data, 200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->repository->update($request);

        return response()->json('Producto actualizado con exito!', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $this->repository->delete($request->id);
        return  response()->json('Usuario eliminado correctamente',200);
    }

    public function suspend(Request $request)
    {
        $this->repository->suspend($request->id);
        return response()->json('Usuario suspendido correctamente',200);
    }
}
