@extends('_layouts.manage.app')
@section('title', trans('Navbar').trans('Edit'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ trans('Navbar').trans('Edit') }}</div>

                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>{{ App\Button::GoBack(route('navbar.index')) }}</li>
                    </ul>
                    <form method="POST" action="{{ route('navbar.update' , $navbar->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('Navbar').trans('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $navbar->name }}" required autocomplete="{{ trans('Page name') }}" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link" class="col-md-4 col-form-label text-md-right">{{ trans('Link') }}</label>

                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ $navbar->link }}" autocomplete="{{ trans('Link') }}" autofocus>

                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ trans('Type') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('type') is-invalid @enderror" name='type' required aria-describedby="typeHelp">
                                    @foreach(App\Enum::type['navbar'] as $key => $value)
                                        @if ($key == $navbar->type)
                                            <option value='{{ $key }}' selected>{{ $value }}</option>
                                        @else
                                            <option value='{{ $key }}'>{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span id="typeHelp" class="form-text text-muted">
                                    導覽目錄：顯示選單目錄；</br>
                                    一般頁面：不顯示選單目錄，直接列出底下的頁面；</br>
                                </span>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="is_open" class="col-md-4 col-form-label text-md-right">{{ trans('Is_open') }}</label>
                            <div class="form-inline col-md-6">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_open" id="is_open1" value="1" {{ ($navbar->is_open=="1")? "checked" : "" }}>
                                    <label class="custom-control-label" for="is_open1">{{ trans('Yes') }}</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_open" id="is_open2" value="0" {{ ($navbar->is_open=="0")? "checked" : "" }}>
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
