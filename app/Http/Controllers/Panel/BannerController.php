<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Banner;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->Middleware('auth');
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $banners = Banner::all();

        return view('panel.banners.index', compact('banners'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('panel.banners.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $status = isset($request->status[0]) ? 1 : 0;

        $banner = new Banner();
        $banner->title = $request->title;
        $banner->slug = Str::slug($request->title);
        $banner->description = $request->description;
        $banner->link = $request->link;
        $banner->status = $status;

        if ($request->hasFile('image')) {
            $banner->image = $this->saveBannerImage($banner, $request);
        }
        $banner->save();

        return redirect()->route('panel.banners.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $banner = Banner::find($id);

        return view('panel.banners.edit', compact('banner'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $status = isset($request->status[0]) ? 1 : 0;

        $banner = Banner::find($id);
        $banner->title = $request->title;
        $banner->slug = Str::slug($request->title);
        $banner->description = $request->description;
        $banner->link = $request->link;
        $banner->status = $status;
        if ($request->hasFile('image')) {
            $this->deleteBannerImage($banner);
            $banner->image = $this->saveBannerImage($banner, $request);
        }
        $banner->update();

        return redirect()->route('panel.banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $banner = Banner::find($id);
        $this->deleteBannerImage($banner);
        $banner->delete();

        return redirect()->back();
    }

    private function deleteBannerImage($banner){
        if( $banner->image ){
            $imgDestroy = public_path('storage/media/banner/'.$banner->image);
            if ( file_exists($imgDestroy) ) unlink($imgDestroy);
        }
    }

    private function saveBannerImage($banner, $request){
        $image = $request->file('image');
        $filenameWithExtension = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        $image->storeAs('public/media/banner', $filenameToStore);

        return $filenameToStore;
    }

}
