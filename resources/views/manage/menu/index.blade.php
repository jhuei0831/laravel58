@extends('_layouts.manage.app')
@section('title', trans('Menu').trans('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ trans('Menu').trans('Manage') }}</div>

                <div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
						<li class="list-inline-item">{{ App\Button::To(true,'sort',trans('Sort'),'','btn-primary') }}</li>
					</ul>
					<div class="alert alert-warning" role="alert">
                        若有建立連結，點擊選單則直接跳到該連結頁面。<br>
                    </div>
					<div class="table-responsive">
						<table id="data" class="table table-hover table-bordered text-center">
		                	<thead>
		                		<tr class="table-info active">
		                			<th class="text-nowrap text-center">{{ trans('Menu').trans('Name') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('Navbar') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('Link') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('Sort') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('Is_list') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('Is_open') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('Action') }}</th>
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($all_menus as $menu)
									<tr>
										<td>{{ $menu->name }}</td>
										<td>{{ App\Navbar::where('id','=',$menu->navbar_id)->first('name')['name'] }}</td>
										<td>{{ $menu->link }}</td>
										<td>{{ $menu->sort }}</td>
										<td><font color="{{App\Enum::is_open['color'][$menu->is_list]}}"><i class="fas fa-{{App\Enum::is_open['label'][$menu->is_list]}}"></i></font></td>
										<td><font color="{{App\Enum::is_open['color'][$menu->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$menu->is_open]}}"></i></font></td>
										<td>
											<form class="d-inline" action="{{ route('menu.edit',$menu->id) }}" method="GET">
											@csrf
											{{ App\Button::edit($menu->id) }}
											</form>
											<form class="d-inline" action="{{ route('menu.destroy',$menu->id) }}" method="POST">
											@method('DELETE')
											@csrf
											{{ App\Button::deleting($menu->id) }}
											</form>
										</td>
									</tr>
		                		@endforeach
		                	</tbody>
		                </table>
					</div>
                </div>
                {{-- <div class="card-footer pagination justify-content-center">
					{!! $all_menus->links("pagination::bootstrap-4") !!}
				</div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
