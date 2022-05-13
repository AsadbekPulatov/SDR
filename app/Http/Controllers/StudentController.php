<?php

namespace App\Http\Controllers;

use App\Models\Bino;
use App\Models\Fakultet;
use App\Models\Floor;
use App\Models\Room;
use App\Models\Student;
use App\Rules\PassportNumber;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentController
{

    public function index()
    {
        $role = Auth::user()->role;
        if ($role == 'admin')
            $id = Auth::user()->id;
        elseif ($role == 'user')
            $id = Auth::user()->user_id;
        $post = Student::where('user_id', $id)->paginate(15);
//        $post = Student::paginate(15);
        return view('admin.students.index', ["posts" => $post]);
    }

    public function create()
    {
        $role = Auth::user()->role;
        if ($role == 'admin')
            $id = Auth::user()->id;
        elseif ($role == 'user')
            $id = Auth::user()->user_id;
        $floors = Floor::all();
        $buildings = Bino::where('user_id', $id)->get();
        $rooms = Room::whereColumn('busy', '<', 'count')->get();
        $fak = Fakultet::where('user_id', $id)->get();

        return view('admin.students.create', [
            "rooms" => $rooms,
            "fakultets" => $fak,
            'buildings' => $buildings,
            'floors' => $floors,
        ]);
    }

    public function store(Request $request)
    {
        $role = Auth::user()->role;
        if ($role == 'admin')
            $id = Auth::user()->id;
        elseif ($role == 'user')
            $id = Auth::user()->user_id;
        $request = $request->validate([
            "name" => 'required ',
            "surname" => 'required ',
            "f_s_name" => 'required ',
            "address" => 'required ',
            "phone" => ['required', new PhoneNumber],
            "passport" => ['required', new PassportNumber],
            "parent_name" => 'required ',
            "parent_phone" => ['required', new PhoneNumber],
            "room_id" => 'required',
            "fak_id" => 'required'
        ]);

        $data = new Student();
        $data->name = $request['name'];
        $data->surname = $request['surname'];
        $data->f_s_name = $request['f_s_name'];
        $data->address = $request['address'];
        $data->phone = $request['phone'];
        $data->passport = $request['passport'];
        $data->parent_name = $request['parent_name'];
        $data->parent_phone = $request['parent_phone'];
        $data->room_id = $request['room_id'];
        $data->fak_id = $request['fak_id'];
        $data->user_id = $id;
        $data->save();
        //busy++
        $id = $request['room_id'];
        $d = Room::find($id);
        $d->busy += 1;
        $d->save();
        return redirect(route('admin.students.index'));
    }

    public function edit($id)
    {
        $data = Student::find($id);
        $room_old = Room::find($data->room_id);
        $fak_old = Fakultet::find($data->fak_id);

        $rooms = Room::whereColumn('busy', '<', 'count')->get();
        $fak = Fakultet::all();

        return view('admin.students.edit', [
            "rooms" => $rooms,
            "fakultets" => $fak,
            "data" => $data,
            "room_old" => $room_old,
            "fak_old" => $fak_old
        ]);
    }

    public function update(Request $request, $id)
    {
        $request = $request->validate([
            "name" => 'required ',
            "surname" => 'required ',
            "f_s_name" => 'required ',
            "address" => 'required ',
            "phone" => ['required', new PhoneNumber],
            "passport" => ['required', new PassportNumber],
            "parent_name" => 'required ',
            "parent_phone" => ['required', new PhoneNumber],
            "room_id" => 'required',
            "fak_id" => 'required'
        ]);
        $data = Student::find($id);
        $data->name = $request['name'];
        $data->surname = $request['surname'];
        $data->f_s_name = $request['f_s_name'];
        $data->address = $request['address'];
        $data->phone = $request['phone'];
        $data->passport = $request['passport'];
        $data->parent_name = $request['parent_name'];
        $data->parent_phone = $request['parent_phone'];
        if ($data->room_id != $request['room_id']) {
            $room = Room::find($data->room_id);
            $room->busy -= 1;
            $room->save();

            $room = Room::find($request['room_id']);
            $room->busy += 1;
            $room->save();
            $data->room_id = $request['room_id'];
        }
        $data->fak_id = $request['fak_id'];
        $data->
        $data->save();

        return redirect(route('admin.students.index'));
    }

    public function show($id)
    {
        $data = Student::find($id);
        $fak = Fakultet::find($data->fak_id);
        $room = Room::find($data->room_id);
        $sheriklari = Student::all()->where('room_id', '=', $data->room_id);
        return view('admin.students.show', [
            "data" => $data,
            "fakultet" => $fak,
            "room" => $room,
            "sheriklar" => $sheriklari
        ]);
    }

    public function destroy($id)
    {

        $data = Student::find($id);
        $room = Room::find($data->room_id);
        $room->busy -= 1;
        $room->save();
        $data->delete();

        return redirect(route('admin.students.index'));


    }
}
