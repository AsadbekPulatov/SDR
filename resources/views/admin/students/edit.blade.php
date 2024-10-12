@extends('admin.master')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-10"><h1 class="card-title">Talaba ma'lumotlarini tahrirlash</h1></div>
                </div>
                <hr>
                <div class="card-body">
                    <form action="{{route('admin.students.update',$data->id)}}" method="POST" accept-charset="UTF-8">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="header_ru">Ismni kiriting</label>
                            <input type="text" name="name" value="{{$data->name}}" class="form-control" id="header_ru"
                                   placeholder="Ism">
                        </div>
                        <div class="form-group">
                            <label for="header_ru">Familyani kiriting</label>
                            <input type="text" name="surname" value="{{$data->surname}}" class="form-control"
                                   id="header_ru" placeholder="Familya">
                        </div>
                        <div class="form-group">
                            <label for="header_ru">Sharifni kiriting</label>
                            <input type="text" name="f_s_name" value="{{$data->f_s_name}}" class="form-control"
                                   id="header_ru" placeholder="Sharif">
                        </div>
                        <div class="form-group">
                            <label for="header_ru">Manzilni kiriting</label>
                            <input type="text" name="address" value="{{$data->address}}" class="form-control"
                                   id="header_ru" placeholder="Manzil">
                        </div>
                        <div class="form-group">
                            <label for="header_ru">Pasport seriyasi va raqami</label>
                            <input type="text" name="passport" value="{{$data->passport}}" class="form-control"
                                   id="header_ru" placeholder="AA0000000">
                        </div>
                        <div class="form-group">
                            <label for="header_ru">Telefon raqami</label>
                            <input type="text" name="phone" value="{{$data->phone}}" class="form-control" id="header_ru"
                                   placeholder="+998883621700">
                        </div>
                        <div class="form-group">
                            <label for="header_ru">Ota-onasining ma'lumoti</label>
                            <input type="text" name="parent_name" value="{{$data->parent_name}}" class="form-control"
                                   id="header_ru" placeholder="Familya Ism Sharif">
                        </div>
                        <div class="form-group">
                            <label for="header_ru">Ota-onasining telefon raqami </label>
                            <input type="text" name="parent_phone" value="{{$data->parent_phone}}" class="form-control"
                                   id="header_ru" placeholder="+998883621700">
                        </div>
                        <div class="form-group">
                            <select name="room_id" class="form-select form-control form-select-lg mb-3"
                                    aria-label=".form-select-lg example">
                                <option value="{{$room_old->id}}" selected>{{$room_old->room_number}}</option>
                                @foreach($rooms as $room)
                                    @if($room->id==$room_old->id)
                                        @continue
                                    @endif
                                    <option value="{{$room->id}}">{{$room->room_number}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="fak_id" class="form-select form-control form-select-lg mb-3"
                                    aria-label=".form-select-lg example">
                                <option value="{{$fak_old->id}}" selected>{{$fak_old->name}}</option>
                                @foreach($fakultets as $fak)
                                    @if($fak->id==$fak_old->id)
                                        @continue
                                    @endif
                                    <option value="{{$fak->id}}">{{$fak->name}}</option>
                                @endforeach

                            </select>
                        </div>

                        <button type="submit" id="alert" class="btn btn-primary">Saqlash</button>
                        <input type="reset" class="btn btn-danger" value="Tozalash">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

        let errors =@json($errors->all());
        @if($errors->any())
        console.log(errors);

        let msg = '';
        for (let i = 0; i < errors.length; i++) {
            msg += (i + 1) + '-xatolik ' + errors[i] + '\n';
        }
        console.log(msg);
        if (msg != '') {
            swal({
                icon: 'error',
                title: 'Xatolik',
                text: msg,
                confirmButtonText: 'Continue',
            })

        }
        @endif
    </script>
@endsection

