@extends('_layouts.manage.app')
@section('title', trans('Menu').trans('Create'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('menu.store') }}" method="POST">
                    <div class="card-header">{{ trans('Menu').trans('Create') }}</div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('menu.index')) }}</li>
                        </ul>
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('Menu').trans('Name') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="{{ trans('Menu').trans('Name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="navbar_id" class="col-md-4 col-form-label text-md-right">{{ trans('Navbar') }}</label>
                            <div class="col-md-4">
                                <select class='form-control' name='navbar_id' required aria-describedby="navHelp" required>
                                    <option value=''>請選擇導覽列</option>
                                    @foreach($navbars as $key => $value)
                                        <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                    @endforeach
                                </select>
                                <span id="navHelp" class="form-text text-muted">
                                    選擇要加入的導覽列項目。
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="link" class="col-md-4 col-form-label text-md-right">{{ trans('Link') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link') }}" placeholder="{{ trans('Link') }}">
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
                                    <input class="custom-control-input" type="radio" name="is_list" id="is_list1" value="1">
                                    <label class="custom-control-label" for="is_list1">{{ trans('Yes') }}</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_list" id="is_list2" value="0">
                                    <label class="custom-control-label" for="is_list2">{{ trans('No') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="is_open" class="col-md-4 col-form-label text-md-right">{{ trans('Is_open') }}</label>
                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_open" id="is_open1" value="1">
                                    <label class="custom-control-label" for="is_open1">{{ trans('Yes') }}</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_open" id="is_open2" value="0">
                                    <label class="custom-control-label" for="is_open2">{{ trans('No') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" class="btn btn-primary" value="{{ trans('Create') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
