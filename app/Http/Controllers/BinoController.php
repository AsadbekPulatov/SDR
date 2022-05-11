<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\Room;
use App\Models\Bino;
use Illuminate\Http\Request;

class BinoController extends Controller
{
    public function index()
    {

        $data = Bino::all();

        return view('admin.binos.bino', compact('data'));

    }

    public function create()
    {

        return view('admin.binos.addbino');

    }


    public function store(Request $request)
    {

        $data = new Bino();
        $data->name = $request->name;
        $data->user_id = $request->user_id;
        $data->save();

        return redirect(route('admin.binos.index'));
    }

    public function edit($id)
    {

        $data = Bino::find($id);
        return view('admin.binos.editbino', compact('data'));

    }


    public function update(Request $request, $id)
    {

        $data = Bino::find($id);
        $data->name = $request->name;
        $data->user_id = $request->user_id;
        $data->save();

        return redirect(route('admin.binos.index'));


    }

    public function destroy($id)
    {

        $data = Bino::find($id);
        $data->delete();

        return redirect(route('admin.binos.index'));

    }


}
