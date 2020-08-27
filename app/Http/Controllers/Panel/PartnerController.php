<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Partner;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PartnerController extends Controller
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
        $partners = Partner::all();

        return view('panel.partners.index', compact('partners'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('panel.partners.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $partner = new Partner();
        $partner->name = $request->name;
        $partner->slug = Str::slug($request->name);
        if ($request->hasFile('image')) {
            $partner->logo = $this->savePartnerLogo($partner, $request);
        }
        $partner->save();

        return redirect()->route('panel.partners.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $partner = Partner::find($id);

        return view('panel.partners.edit', compact('partner'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $partner = Partner::find($id);
        $partner->name = $request->name;
        $partner->slug = Str::slug($request->name);
        if ($request->hasFile('image')) {
            $this->deletePartnerLogo($partner);
            $partner->logo = $this->savePartnerLogo($partner, $request);
        }
        $partner->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $partner = Partner::find($id);
        $this->deletePartnerLogo($partner);
        $partner->delete();

        return redirect()->back();
    }

    private function deletePartnerLogo($partner){
        if( $partner->logo ){
            $imgDestroy = public_path('storage/media/partner/'.$partner->logo);
            if ( file_exists($imgDestroy) ) unlink($imgDestroy);
        }
    }

    private function savePartnerLogo($partner, $request){
        $image = $request->file('image');
        $filenameWithExtension = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        $image->storeAs('public/media/partner', $filenameToStore);

        return $filenameToStore;
    }

}
