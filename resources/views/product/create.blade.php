@extends('product.layouts.main')

@section('title-block')<title>Создание нового продукта</title>@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Создание нового продукта</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if(session('success'))
            <h6 class="alert alert-success col-md-3">{{session('success')}}</h6>
        @endif
        @if(session('msg'))
            <h6 class="alert alert-danger col-md-3">{{session('msg')}}</h6>
        @endif
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('product.store') }}" method="POST">
                @csrf
                <div class="form-group col-md-3">
                    <label>Артикул:</label>
                    <input class="form-control" type="text" name="article" value="{{ old('article') }}">
                    @error('article')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label>Название:</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label>Доступность:</label>
                        <input class="form-control" type="checkbox" name="status"
                        style="width: 25px;"
                        >
                </div>
                <div class="form-group col-md-3">
                    <label>Объем видеопамяти (ГБ):</label>
                    <input class="form-control" type="text" name="videoram" value="{{ old('videoram') }}">
                </div>
                <div class="form-group col-md-3">
                    <label>Тип памяти:</label>
                    <input class="form-control" type="text" name="ram_type" value="{{ old('ram_type') }}">
                </div>
                <div class="form-group col-md-4">
                    <input type="submit" class="btn btn-primary" value="Создать">
                </div>
                </form>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection