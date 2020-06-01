@extends('_layouts.manage.app')
@section('title', __('Log').__('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Log').__('Manage') }}</div>
                <div class="card-body">
					<div class="table-responsive">
						<table id="data" class="table table-hover table-bordered text-center">
							<thead>
								<tr class="table-info active">
									<th class="text-nowrap text-center">{{ __('Member') }}</th>
									<th class="text-nowrap text-center">{{ __('IP') }}</th>
									<th class="text-nowrap text-center">{{ __('Browser') }}</th>
									<th class="text-nowrap text-center">{{ __('Action') }}</th>
									<th class="text-nowrap text-center">{{ __('Table') }}</th>
									<th class="text-nowrap text-center">{{ __('Created_at') }}</th>
									<th class="text-nowrap text-center">*</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($logs as $log)
									<tr>
										<td>{{ $log->user }}</td>
										<td>{{ $log->ip }}</td>
										<td>{{ $log->browser }}</td>
										<td>{{ $log->action }}</td>
										<td>{{ $log->table }}</td>
										<td>{{ $log->created_at }}</td>
										<td>
											<form action="{{ route('log.show',$log->id) }}" method="GET">
											@csrf
											{{ App\Button::detail($log->id) }}
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
                </div>
                <div class="card-footer pagination justify-content-center table-responsive">
					{!! $logs->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
