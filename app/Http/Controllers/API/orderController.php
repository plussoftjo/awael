<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\order;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = order::get();
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/orders/image/').$fileNameimage);


        $imageI = $request->get('imageI');
        $fileNameimageI = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($imageI, 0, strpos($imageI, ';')))[1])[1];
        Image::make($request->get('imageI'))->save(public_path('images/orders/imageI/').$fileNameimageI);

        $order= order::create([
            'name' => $request->name,
            'cv_id' => $request->id,
            'phone' => $request->phone,
            'city' => $request->city,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'post' => $request->post,
            'image' => 'images/orders/image/'.$fileNameimage,
            'imageI' => 'images/orders/imageI/'.$fileNameimageI,

        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $order = order::where('id',$id)->update([
            'status' => 1
        ]);
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
