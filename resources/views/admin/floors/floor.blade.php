@extends('admin.master')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-9"><h1 class="card-title">Qavatlar</h1></div>
                    <div class="col-md-1">
                        <a class="btn btn-primary" href="{{route('admin.floors.create')}}">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Qavat qo'shing
                        </a>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Bino nomi</th>
                            <th scope="col">Qavat raqami</th>
                            <th scope="col">Ammallar</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $post)
                            <tr>
                                <td scope="row" class="col-1"> {{$key+1}}</td>
                                <td>{{$post->bino->name}} </td>
                                <td>{{$post->floor}}</td>
                                <td class="col-2">
                                    <form action="{{ route('admin.floors.destroy',$post->id) }}" method="POST">
                                        <a class="btn btn-warning btn-sm" href="{{ route('admin.floors.edit',$post->id) }}">
                                        <span class="btn-label">
                                            <i class="fa fa-pen"></i>
                                        </span>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <span class="btn-label">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <section class="content12 cid-t34gh8nW7r" id="content12-2s">

{{--                        <div class="container">--}}
{{--                            <div class="row justify-content-center">--}}
{{--                                @if ($data->links())--}}
{{--                                    <div class="mt-4 p-4 box has-text-centered">--}}
{{--                                        {{ $data->links() }}--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </section>
                </div>
            </div>
        </div>
    </div>



@endsection


