<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;


class ProductController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new ProductRepository();
    }

    public function index(Request $request)
    {
        $data = $this->repository->all();
 
        return response()->json($data, 200);   
    }

    public function findByGuid(Request $request, $guid)
    {
        $data = $this->repository->byGuid($guid);

        return response()->json($data, 200);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        //VALIDACION DE LA REQUEST

        //generar uuid
        $guid = Uuid::generate(8)->string;

        $request->request->add(['product_guid'=>$guid]);

        $product = Product::create($request->validate());

         return  response()->json($product, 200, "Exito");


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
