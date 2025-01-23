@extends('product.layouts.main')

@section('title-block')<title>Продукт {{ $product->title }}</title>@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $product->name }}</h1>
            <h5 class="m-0">
                {{ $product->article }} <small>(Статус: {{ $statuses[$product->status]['title'] }})</small>
            </h5>
            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-outline-primary mt-1">Редактировать</a>
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
        <div class="product__image mb-2">
            <a href="{{ route('product.show', $product->id) }}">
                <img src="https://placehold.co/400x250">
            </a>
        </div>
        <div class="product__descr">
          @isset($product->data->videoram)
              <h5><b>Объем видеопамяти:</b> {{ $product->data->videoram }} ГБ</h5>
          @endisset
          @isset($product->data->ram_type)
              <h5><b>Тип памяти:</b> {{ $product->data->ram_type }}</h5>
          @endisset
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection