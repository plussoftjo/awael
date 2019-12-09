<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\section;
use App\secondSection;
use App\country;
use App\cv;
class mainController extends Controller
{
    public function index() {
    	$sections = section::get();
    	$secondSections = secondSection::get();
    	$countrys = country::get();

    	return response()->json(['sections' => $sections,'secondSections' => $secondSections,'countrys' => $countrys]);
    }

    public function fetchResult(Request $req) {
    	$cv = cv::where('natonalty',$req->country)->where('section',$req->section)->get();
    	return response()->json($cv);
    }

    public function fetchResultSearch(Request $req) {
        $cv = cv::where('natonalty',$req->country)->where('section',$req->section)->where('status',$req->status)->where('gender',$req->gender)->get();
        return response()->json($cv);
    }

    public function profile($id) 
    {
    	$cv = cv::where('id',$id)->first();
    	return response()->json($cv);
    }
}
