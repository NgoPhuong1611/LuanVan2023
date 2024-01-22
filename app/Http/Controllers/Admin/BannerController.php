<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Banner = Banner::first();
        return view('Admin.Banner.index', ['Banner' => $Banner]);
    }
    public function save(Request $request)
    {
        $banner = Banner::first();
        $questionImage = $request->file('Banner_Banner');

        if ($questionImage) {
            $fileName = $questionImage->getClientOriginalName();
            $filePath = $questionImage->move('resources/file/images/slide/', $fileName);
            $fullPath = public_path('resources/file/images/slide/' . $fileName);

            // Check if the Banner already has an image, then delete the old image
            if ($banner->img_name) {
                unlink(public_path('resources/file/images/slide/' . $banner->img_name));
            }

            // Update the image_name in the Banner table
            $banner->img_name = $fileName;
            $banner->save();
        }
        return redirect()->to('dashboard/banner');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //
    }
}
