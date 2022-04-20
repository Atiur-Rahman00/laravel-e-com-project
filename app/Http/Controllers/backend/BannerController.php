<?php

namespace App\Http\Controllers\backend;

use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //To view all banner
        $all_data = Banner::all();
        $trashed_data = Banner::onlyTrashed()->get();
        return view('backend.banner.index',compact('all_data','trashed_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //To create banner
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //To store banner data
        $this->validate($request, [
            'banner_title' => 'required',
            'banner_description' => 'max:300',
            'banner_image' => 'required|image|mimes:png,jpg|max:1024'
        ]);
        $banner_image = $request->file('banner_image');
        $banner_image_name = Str::slug($request->banner_title)."_".time().".".
        $banner_image->getClientOriginalExtension();
        $upload_banner = $banner_image->move(public_path('/storage/uploads/banner/'),$banner_image_name);
        if($upload_banner){
            $banner = new Banner();
            $banner->banner_title = $request->banner_title;
            $banner->banner_description = $request->banner_description;
            $banner->banner_image = $banner_image_name;
            $banner->save();
            return redirect(route('backend.banner.index'))->with('success','banner insert successfully done!');
        }
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
        //To edit banner
        return view('backend.banner.edit ', compact('banner'));
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
        //To update banner data
        $this->validate($request, [
            'banner_title' => 'required',
            'banner_description' => 'max:300',
            'banner_image' => 'image|mimes:png,jpg|max:1024'
        ]);
        $banner_image = $request->file('banner_image');
        if(!empty($banner_image)){
        $banner_image_name = Str::slug($request->banner_title)."_".time().".".
        $banner_image->getClientOriginalExtension();
        $upload_banner = $banner_image->move(public_path('/storage/uploads/banner/'),$banner_image_name);

        $ex_file = public_path('/storage/uploads/banner/'.$banner->banner_image);
        if(file_exists($ex_file)){
            unlink($ex_file);
        }
        }else{
            $banner_image_name = $banner->banner_image;
        }

            $banner->banner_title = $request->banner_title;
            $banner->banner_description = $request->banner_description;
            $banner->banner_image = $banner_image_name;
            $banner->save();
            return redirect(route('backend.banner.index'))->with('success','banner update successfully done!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //to trashed data
        $banner->delete();
        if($banner->status == 1){
            $banner->status = 2;
            $banner->save();
        }else{
            $banner->status = 1;
            $banner->save();
        }
        return back()->with('success', 'content deleted successfully!');
    }

    //To active deactive banner status
    public function statusUpdate(Banner $banner){
        if($banner->status == 1){
            $banner->status = 2;
            $banner->save();
            return back()->with('success', 'status updated successfully!');
        }else{
            $banner->status = 1;
            $banner->save();
            return back()->with('success', 'status updated successfully!');
        }
    }
    //To Restore banner 
    public function bannerRestore($id){
        $restore_id = Banner::onlyTrashed()->find($id);
        $restore_id->restore();
        if($restore_id->status == 1){
            $restore_id->status = 2;
            $restore_id->save();
        }else{
            $restore_id->status = 1;
            $restore_id->save();
        }
        return back()->with('success', 'data restore successfully!');
    }

    //To delete banner permanently
    public function permanentDelete($id){
        $permanentdlt = Banner::onlyTrashed()->find($id);
        $permanentdlt -> forceDelete();
        $ex_file = public_path('/storage/uploads/banner/'.$permanentdlt->banner_image);
        if(file_exists($ex_file)){
            unlink($ex_file);
        }
        return back()->with('success', 'Banner deleted successfully!');
    }

}
