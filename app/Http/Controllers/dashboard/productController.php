<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->middleware('auth');
        $this->repository = new ProductRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.products.index');
    }

    public function show(Request $request)
    {
        //Peticion por GET
        if ($request->has('id')) {
           $data = $this->repository->byGuid($request->id);
        } else {
           $data = $this->repository->all();
        }

        return response()->json($data, 200);
    }

    public function showAll(Request $request)
    {
        //Peticion por GET
            $data = $this->repository->all();

        return response()->json($data, 200);
    }


    public function create(Request $request)
    {
        $this->repository->insert($request);

        return response()->json('Producto creado con exito!', 200);
    }

    public function update(Request $request, $id=0)
    {
        $this->repository->update($request);

        return response()->json('Producto actualizado con exito!', 200);
    }

    public function destroy(Request $request, $id=0)
    {
        $this->repository->delete($request->guid);

        return response()->json('Producto borrado con exito!', 200);
    }
    public function publishProduct(Request $request ,$id=0)
    {
        $this->repository->publish($request->guid);
        return response()->json('Producto publicado correctamente',200);
    }
    public function uploadImage(Request $request ,$id=0)
    {
        $this->repository->publish($request);
        return response()->json('Producto publicado correctamente',200);
    }
}
