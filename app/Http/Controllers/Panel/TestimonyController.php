<?php

namespace App\Http\Controllers\Panel;

use App\Testimony;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $testimonies = Testimony::all();

        return view('panel.testimonies.index', compact('testimonies'));
    }

    public function edit($id) {
        $testimony = Testimony::find($id);

        return view('panel.testimonies.edit', compact('testimony'));
    }

    public function update(Request $request, $id) {

        $status = isset($request->status[0]) ? 1 : 0;

        $testimony = Testimony::find($id);
        $testimony->body = $request->body;
        $testimony->status = $status;
        $testimony->update();

        return redirect()->route('panel.testimonies.index');
    }

    public function delete($id) {
        $testimony = Testimony::find($id);
        $testimony->delete();

        return redirect()->back();
    }

}
