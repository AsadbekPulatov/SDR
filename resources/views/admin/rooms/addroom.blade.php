@extends('admin.master')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-10"><h1 class="card-title">Xona qo'shing</h1></div>
                </div>
                <hr>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Qayerdadir Xatolik bo`ldi!..<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{route('admin.rooms.store')}}" method="POST" accept-charset="UTF-8" id="myForm">
                        @csrf

                        <div class="form-group">
                            <label for="number"> Xona raqami </label>
                            <input type="text" name="number" class="form-control"  placeholder="000-A" id="number">
                        </div>


                        <div class="form-group">
                            <label for="header_ru"> O`rinlar soni </label>
                            <input type="number" name="count" class="form-control" placeholder="0">
                        </div>

                        <div class="form-group">
                            <select name="floor_id" required class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example" id="building">
                                <option value="0" selected>Binoni tanlang</option>
                                @foreach($binos as $bino)
                                    <option value="{{$bino->id}}">{{$bino->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="floor_id" required class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example" id="floor">
                                <option value="0" selected>Qavatni tanlang</option>

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
        let buildings = @json($binos);
        let floors = @json($floors);
        $('#building').on('change', function () {
            var value = $(this).val();
            $('#floor').empty();
            $('#floor').append("<option value='none'>Qavatni tanlang</option>")
            for (let i = 0; i < floors.length; i++) {
                if (value == floors[i].bino_id) {
                    var option = document.createElement("option");   // Create with DOM
                    option.innerHTML = floors[i].floor;
                    option.value = floors[i].id;
                    $('#floor').append(option);
                }
            }
        });
        let facultets = @json($rooms);
        console.log(facultets);
        $(document).on('click', '#alert', function (e) {
            e.preventDefault();
            let cnt = 0;
            var value = $('#number').val();
            var floor = $('#floor').val();
            if (facultets.length == 0) $('#myForm').submit();
            for (let i = 0; i < facultets.length; i++) {
                if (value == facultets[i].room_number && floor == facultets[i].floor_id) {
                    cnt++;
                }
            }
            if (cnt > 0) {
                swal({
                    icon: 'error',
                    title: 'Xatolik',
                    text: 'Bu xona oldin kiritilgan',
                    confirmButtonText: 'Continue',
                })
                $('#number').val('');
            } else if ($('#number').val() != '') {
                swal({
                    icon: 'success',
                    text: 'Xona yaratildi',
                    confirmButtonText: 'Continue',
                })
                $('#myForm').submit();
            } else $('#myForm').submit();
        });
    </script>
@endsection
