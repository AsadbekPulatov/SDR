@extends('admin.master')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-9"><h1 class="card-title">Foydalanuvchi</h1></div>
                    <div class="col-md-1">
                        @if(\Illuminate\Support\Facades\Auth::user()->role != 'user')
                            <a class="btn btn-primary" href="{{route('admin.users.create')}}">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                                Foydalanuvchi qo'shing
                            </a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roli</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->role == 'super_admin')
                                <th scope="col">Status</th>
                            @endif
                            <th scope="col">Harakat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <th scope="row" class="col-1">{{ $key+1 }}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                @if(\Illuminate\Support\Facades\Auth::user()->role == 'super_admin')
                                    <td>
                                        @if ($user->role != 'super_admin')
                                            @if($user->status == 0)
                                                <a href="{{ route('admin.user.status', ['user' => $user->id]) }}" class="btn btn-danger">Yoqish</a>
                                            @else
                                                <a href="{{ route('admin.user.status', ['user' => $user->id]) }}" class="btn btn-success">O'chirish</a>
                                            @endif
                                        @endif
                                    </td>
                                @endif
                                <td class="col-2">
                                    @if(\Illuminate\Support\Facades\Auth::id() == $user->id)
                                        <a class="btn btn-warning btn-sm"
                                           href="{{ route('admin.users.edit',$user->id) }}">
                                            <span class="btn-label">
                                                <i class="fa fa-pen"></i>
                                            </span>
                                        </a>
                                    @else
                                        <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm show_confirm">
                                                <span class="btn-label">
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    @if(session('success'))

        <script>
            swal({
                icon: 'success',
                text: 'Muvaffaqqiyatli bajarildi',
                confirmButtonText: 'Continue',
            })
        </script>
    @endif
    <script>
        $('.show_confirm').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Haqiqatan ham bu yozuvni oʻchirib tashlamoqchimisiz?`,
                text: "Agar siz buni o'chirib tashlasangiz, u abadiy yo'qoladi.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ['Yo`q', 'Ha']
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>

@endsection
