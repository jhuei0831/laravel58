@extends('_layouts.manage.app')
@section('title', trans('Navbar').trans('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ trans('Navbar').trans('Manage') }}</div>

                <div class="card-body">
                    <ul class="list-inline">
                        <li class="list-inline-item">{{ App\Button::Create() }}</li>
                        <li class="list-inline-item">{{ App\Button::To(true,'sort',trans('Sort'),'','btn-primary') }}</li>
                    </ul>
                    <div class="alert alert-warning" role="alert">
                        1. 新增頁面連結連結請照{{Request::root()}}/article/導覽列名稱/選單名稱?頁面網址。<br>
                        2. 外部連結請直接貼上整段網址即可。
                    </div>
                    <div class="table-responsive">
                        <table id="data" class="table table-hover table-bordered text-center">
                            <thead>
                                <tr class="table-info active">
                                    <th class="text-nowrap text-center">{{ trans('Navbar').trans('Name') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('Link') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('Type') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('Sort') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('Is_open') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_navbars as $navbar)
                                    <tr>
                                        <td>{{ $navbar->name }}</td>
                                        <td>{{ $navbar->link }}</td>
                                        <td>{{App\Enum::type['navbar'][$navbar->type]}}</td>
                                        <td>{{ $navbar->sort }}</td>
                                        <td><font color="{{App\Enum::is_open['color'][$navbar->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$navbar->is_open]}}"></i></font></td>
                                        <td>
                                            <form class="d-inline" action="{{ route('navbar.edit',$navbar->id) }}" method="GET">
                                            @csrf
                                            {{ App\Button::edit($navbar->id) }}
                                            </form>
                                            <form class="d-inline" action="{{ route('navbar.destroy',$navbar->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            {{ App\Button::deleting($navbar->id) }}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="card-footer pagination justify-content-center">
                    {!! $all_navbars->links("pagination::bootstrap-4") !!}
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
