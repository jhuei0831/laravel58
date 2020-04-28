@extends('_layouts.manage.app')
@section('title', trans('Member').trans('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ trans('Member').trans('Manage') }}</div>

                <div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
					</ul>
					<div class="table-responsive">
						<table id="data" class="table table-hover table-bordered text-center">
		                	<thead>
		                		<tr class="table-info active">
		                			<th class="text-nowrap text-center">{{ trans('Name') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('E-Mail Address') }}</th>
		                			<th class="text-nowrap text-center" style="display:none">{{ trans('Permission') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('Permission') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('Action') }}</th>
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($all_users as $user)
									<tr>
										<td>{{ $user->name }}</td>
										<td>{{ $user->email }}</td>
										<td style="display:none">{{ $user->permission }}</td>
										<td>{{App\Enum::permission[$user->permission]}}</td>
										<td>
											<form action="{{ route('member.edit',$user->id) }}" method="GET">
											@csrf
											{{ App\Button::edit($user->id) }}
											</form>
											<form action="{{ route('member.destroy',$user->id) }}" method="POST">
											@method('DELETE')
											@csrf
											{{ App\Button::deleting($user->id) }}
											</form>
										</td>
									</tr>
		                		@endforeach
		                	</tbody>
	                    </table>
					</div>
                </div>
                <div class="card-footer pagination justify-content-center">
					{!! $all_users->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
