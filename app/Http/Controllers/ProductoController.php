<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $productos = Producto::all();
       return $productos;
    }

    

  
    public function store(Request $request)
    {
             $request->validate([

                'title'=> 'required',
                'description'=> 'required',
               // 'slug' => 'required'
                

            ]);

           
            $producto = Producto::create($request->all());

            return response()->json([
                'res' =>true,
                'mensaje' => "el producto fue creado",
                "data"=> $producto
            ]);
    

          
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return response()->json($producto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductoRequest  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
       

        $producto = Producto::findorFail($request->id);
        $producto->title = $request->title;
        $producto->description = $request->description;
        $producto->slug = Str::slug($request->title);
        
        $producto->save(); 

        return response()->json([
            'res' =>true,
            'mensaje' => "el producto fue actualizado",
            "data"=> $producto
        ]);
        

              //$producto = Producto::findOrFail($id)->update($request->all());
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::destroy($id);
        if($producto == 0){
        return response()->json([
            'res' =>false,
            'mensaje' => "el producto que se intenta eliminar no existe :$id",
            "data"=> $producto
        ]);
    }
        return response()->json([
            'res' =>true,
            'mensaje' => "el producto que se elimino tenia id :$id",
            "data"=> $producto
            ]);
    }
}
