@extends('admin.master')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-10"><h1 class="card-title">Kontaktlarni tahrirlash</h1></div>
                </div>
                <hr>
                <div class="card-body">
                    <form action="{{route('admin.users.update',$user)}}" method="POST" accept-charset="UTF-8">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Ism
                            </label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Имя"
                                   value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Elektron pochta</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Email"
                                   value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Parol</label>
                            <input type="password" name="password" class="form-control" id="pwd">
                        </div>
                        <div class="form-group">
                            <label for="pwd_confirm">Parolni qayta kiriting</label>
                            <input type="password" name="password_confirmation" class="form-control" id="pwd_confirm">
                            <input type="checkbox" onclick="myFunction1()" id="chb">
                            <label for="chb">Parolni ko'rsatish</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Saqlash</button>
                        <input type="reset" class="btn btn-danger" value="Tozalash">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function myFunction1() {
            var x = document.getElementById("pwd_confirm");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            var x = document.getElementById("pwd");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
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
