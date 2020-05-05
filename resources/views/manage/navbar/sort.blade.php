@extends('_layouts.manage.app')
@section('title', trans('Navbar').trans('Sort'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{trans('Navbar').trans('Sort')}}</div>

                <div class="card-body">
					<ul class="list-unstyled">
						<li>{{ App\Button::GoBack(route('navbar.index')) }}</li>
					</ul>
                    <div class="alert alert-warning" role="alert">
                        1. 請直接拖曳目標列進行排序。<br>
                        2. 調整完請點重新整理進行確認。
                    </div>
                	<table id="table" class="table table-hover table-bordered text-center">
	                	<thead>
	                		<tr class="table-info active">
	                			<th class="text-nowrap text-center">{{trans('Navbar').trans('Name')}}</th>
	                			<th class="text-nowrap text-center">{{ trans('Type') }}</th>
	                			<th class="text-nowrap text-center">{{ trans('Sort') }}</th>
	                			<th class="text-nowrap text-center">{{ trans('Is_open') }}</th>
	                		</tr>
	                	</thead>
	                	<tbody id="tablecontents">
							@foreach ($navbars as $navbar)
								<tr class="row1" data-id="{{ $navbar->id }}">
									<td class="pl-3">{{ $navbar->name }}</td>
									<td>{{App\Enum::type['navbar'][$navbar->type]}}</td>
									<td>{{ $navbar->sort }}</td>
									<td><font color="{{App\Enum::is_open['color'][$navbar->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$navbar->is_open]}}"></i></font></td>
								</tr>
	                		@endforeach
	                	</tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                	<h5><button class="btn btn-success btn-sm" onclick="window.location.reload()">{{ trans('Refresh') }}</button></h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@parent
<script type="text/javascript">
    $(function () {
        // $("#table").DataTable();

        $("#tablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
        });

        function sendOrderToServer() {
            var order = [];
            var token = $('meta[name="csrf-token"]').attr('content');
            $('tr.row1').each(function(index,element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index+1
                });
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('navbar-sortable') }}",
                data: {
                    order: order,
                    _token: token
                },
                success: function(response) {
                    if (response.status == "success") {
                      console.log(response);
                    } else {
                      console.log(response);
                    }
                }
            });
        }
    });
</script>
@show
