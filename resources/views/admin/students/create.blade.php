@extends('admin.master')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-10"><h1 class="card-title">Talaba ma'lumotlarini kiriting </h1></div>
                </div>
                <hr>
                <div class="card-body">
                    <form action="{{route('admin.students.store')}}" method="POST" accept-charset="UTF-8">
                        @csrf
                        <div class="form-group">
                            <label for="header_ru">Ismni kiriting</label>
                            <input type="text" required name="name" class="form-control" id="header_ru"
                                   placeholder="Ism" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="header_ru">Familyani kiriting</label>
                            <input type="text" required name="surname" class="form-control" id="header_ru"
                                   placeholder="Familya" value="{{old('surname')}}">
                        </div>
                        <div class="form-group">
                            <label for="header_ru">Sharifni kiriting</label>
                            <input type="text" required name="f_s_name" class="form-control" id="header_ru"
                                   placeholder="Sharif" value="{{old('f_s_name')}}">
                        </div>
                        <div class="form-group">
                            <label for="header_ru">Manzilni kiriting</label>
                            <input type="text" required name="address" class="form-control" id="header_ru"
                                   placeholder="Manzil" value="{{old('address')}}">
                        </div>
                        <div class="form-group">
                            <label for="header_ru">Pasport seriyasi va raqami</label>
                            <input type="text" required name="passport" class="form-control" id="header_ru"
                                   placeholder="AA0000000" value="{{old('passport')}}">
                        </div>
                        <div class="form-group">
                            <label for="header_ru">Telefon raqami</label>
                            <input type="text" required name="phone" class="form-control" id="header_ru"
                                   placeholder="+998883621700" value="{{old('phone')}}">
                        </div>
                        <div class="form-group">
                            <label for="header_ru">Ota-onasining ma'lumoti</label>
                            <input type="text" required name="parent_name" class="form-control" id="header_ru"
                                   placeholder="Familya Ism Sharif" value="{{old('parent_name')}}">
                        </div>
                        <div class="form-group">
                            <label for="header_ru">Ota-onasining telefon raqami </label>
                            <input type="text" required name="parent_phone" class="form-control" id="header_ru"
                                   placeholder="+998883621700" value="{{old('parent_phone')}}">
                        </div>
                        <div class="form-group">
                            <label for="building">Bino</label>
                            <select name="building" required id="building" class="form-select form-control">
                                <option value="">Binoni tanlang</option>
                                @foreach($buildings as $building)
                                    <option value="{{$building->id}}">{{$building->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="floor">Qavat</label>
                            <select name="floor" id="floor" required class="form-select form-control">
                                <option value="" selected >Qavatni tanlang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="room" name="room_id" required
                                    class="form-select form-control form-select-lg mb-3">
                                <option value="" selected>Xonani tanlang</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <select name="fak_id" required class="form-select form-control form-select-lg mb-3"
                                    aria-label=".form-select-lg example">
                                <option value="" selected>Fakultetni tanlang</option>
                                @foreach($fakultets as $fak)
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

        let buildings = @json($buildings);
        let floors = @json($floors);
        let rooms = @json($rooms);

        $('#building').on('change', function () {
            var value = $(this).val();
            $('#floor').empty();
            $('#floor').append("<option value=''>Qavatni tanlang</option>")
            for (let i = 0; i < floors.length; i++) {
                if (value == floors[i].bino_id) {
                    var option = document.createElement("option");   // Create with DOM
                    option.innerHTML = floors[i].floor;
                    option.value = floors[i].id;
                    $('#floor').append(option);
                }
            }
        });
        $('#floor').on('change', function () {
            var room_id = $(this).val();
            $('#room').empty();
            $('#room').append("<option value=''>Xonani tanlang</option>")
            for (let i = 0; i < rooms.length; i++) {
                if (room_id == rooms[i].floor_id) {
                    var option = document.createElement("option");   // Create with DOM
                    option.innerHTML = rooms[i].room_number;
                    option.value = rooms[i].id;
                    $('#room').append(option);
                }
            }
        });

    </script>
    <script>
        let errors = @json($errors->all());
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
