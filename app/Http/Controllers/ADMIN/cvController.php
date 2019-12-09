<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\country;
use App\section;
use App\cv;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
use App\profile;
use App\appDetails;
use App\learn;
use App\skill;
use App\lastjob;

class cvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countrys = country::get();
        $sections = section::get();
        $cvs = cv::get();
        return response()->json(['countrys' => $countrys,'sections'=>$sections,'cvs'=> $cvs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Store CV 

        $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/cv/').$fileNameimage);


        $cv = cv::create([
            'name' => $request->name,
            'natonalty' => $request->natonalty,
            'refcode' => $request->refcode,
            'gender' => $request->gender,
            'status' => $request->status,
            'section' => $request->section,
            'note' => $request->note,
            'image' => 'images/cv/'.$fileNameimage
        ]);

        $profile = profile::create([
            'cv_id' => $cv->id,
            'religion' => $request->religion,
            'height' => $request->height,
            'weight' => $request->weight,
            'payment' => $request->payment,
            'loop' => $request->loop,
            'passportnumber' => $request->passportnumber
        ]);

        $appDetails = appDetails::create([
            'cv_id' => $cv->id,
            'address' => $request->address,
            'natonalty' => $request->natonalty,
            'birthday' => $request->birthday,
            'birthplace' => $request->birthplace,
            'child' => $request->child,
            'status' => $request->status
        ]);

        $learn = learn::create([
            'cv_id' => $cv->id,
            'arabic' => $request->arabic,
            'english' => $request->english,
            'education' => $request->education
        ]);

        foreach ($request->lastJobs as $ls) {
            $lastjob = lastjob::create([
                'cv_id' => $cv->id,
                'country' => $ls['country'],
                'position' => $ls['position'],
                'period' => $ls['period']
            ]);
        }

        foreach ($request->skills as $skill) {
            $skill = skill::create([
                'cv_id' => $cv->id,
                'title' => $skill['title']
            ]);
        }

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
        $cv = cv::where('id',$id)->delete();
        $profile = profile::where('cv_id',$id)->delete();
        $appDetails = appDetails::where('cv_id',$id)->delete();
        $learn = learn::where('cv_id',$id)->delete();
        $skill = skill::where('cv_id',$id)->delete();
        $lastjob = lastjob::where('cv_id',$id)->delete();
    }
}
