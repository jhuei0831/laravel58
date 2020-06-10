@extends('_layouts.manage.app')
@section('title', trans('Page').trans('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ trans('Page').trans('Manage') }}</div>

                <div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
					</ul>
					<div class="alert alert-warning" role="alert">
                        1. 前台排序以頁面修改日期為主。<br>
                        2. 頁面網址唯一，用途為導向該頁面。
                    </div>
                    <div class="table-responsive">
	                    <table id="data" class="table table-hover table-bordered text-center">
		                	<thead>
		                		<tr class="table-info active">
		                			<th class="text-nowrap text-center">{{ trans('Editor') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('Menu') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('Title') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('Page').trans('Url') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('Is_open') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('Is_slide') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('Action') }}</th>
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($all_pages as $page)
									<tr>
										<td>{{ $page->editor }}</td>
                                        <td>{{ App\Menu::where('id','=',$page->menu_id)->first('name')['name'] }}</td>
										<td>{{ $page->title }}</td>
										<td>
											{{ $page->url }}
										</td>
										<td>
											<font color="{{App\Enum::is_open['color'][$page->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$page->is_open]}}"></i></font>
										</td>
										<td>
											<font color="{{App\Enum::is_open['color'][$page->is_slide]}}"><i class="fas fa-{{App\Enum::is_open['label'][$page->is_slide]}}"></i></font>
										</td>
										<td>
											<form class="d-inline" action="{{ route('page.edit',$page->id) }}" method="GET">
											@csrf
											{{ App\Button::edit($page->id) }}
											</form>
											<form class="d-inline" action="{{ route('page.destroy',$page->id) }}" method="POST">
											@method('DELETE')
											@csrf
											{{ App\Button::deleting($page->id) }}
											</form>
										</td>
									</tr>
		                		@endforeach
		                	</tbody>
	                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
