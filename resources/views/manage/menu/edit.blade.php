@extends('_layouts.manage.app')
@section('title', trans('Menu').trans('Edit'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ trans('Menu').trans('Edit') }}</div>

                <div class="card-body">
                	<ul class="list-unstyled">
						<li>{{ App\Button::GoBack(route('menu.index')) }}</li>
					</ul>
                	<form method="POST" action="{{ route('menu.update' , $menu->id) }}">
                		@csrf
						@method('PUT')
						<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('Menu').trans('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $menu->name }}" required autocomplete="{{ trans('Menu').trans('Name') }}" autofocus readonly>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="navbar_id" class="col-md-4 col-form-label text-md-right">{{ trans('Navbar') }}</label>
                            <div class="col-md-6">
                                <select class='form-control' name='navbar_id' required aria-describedby="navHelp">
                                    @foreach($navbars as $key => $value)
                                        @if ($value['id'] == $menu->navbar_id)
                                            <option value="{{ $value['id'] }}" selected>{{ $value['name'] }}</option>
                                        @else
                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span id="navHelp" class="help-block">
                                    選擇要加入的導覽列項目。
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link" class="col-md-4 col-form-label text-md-right">{{ trans('Link') }}</label>

                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ $menu->link }}" autocomplete="{{ trans('Link') }}" autofocus>

                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="is_list" class="col-md-4 col-form-label text-md-right">{{ trans('Is_list') }}</label>
                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_list" id="is_list1" value="1" {{ ($menu->is_list=="1")? "checked" : "" }}>
                                    <label class="custom-control-label" for="is_list1">{{ trans('Yes') }}</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_list" id="is_list2" value="0" {{ ($menu->is_list=="0")? "checked" : "" }}>
                                    <label class="custom-control-label" for="is_list2">{{ trans('No') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="is_open" class="col-md-4 col-form-label text-md-right">{{ trans('Is_open') }}</label>
                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_open" id="is_open1" value="1" {{ ($menu->is_open=="1")? "checked" : "" }}>
                                    <label class="custom-control-label" for="is_open1">{{ trans('Yes') }}</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_open" id="is_open2" value="0" {{ ($menu->is_open=="0")? "checked" : "" }}>
                                    <label class="custom-control-label" for="is_open2">{{ trans('No') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
			                <div class="col-md-4">
			                    <input type="submit" class="btn btn-primary" value="送出">
			                </div>
			            </div>
                	</form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
