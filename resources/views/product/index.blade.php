@extends('product.layouts.main')

@section('title-block')<title>Список продуктов</title>@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Управление списком продуктов</h1>
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
        <a href="{{ route('product.create') }}" class="btn btn-primary mb-1">Создать продукт</a>
        <div class="row">
            @foreach ($products as $product)
                <div class="card ml-2 p-2 col-md-3">
                    <div class="card__image">
                        <a href="{{ route('product.show', $product->id) }}">
                            <img src="https://placehold.co/200x150">
                        </a>
                    </div>
                    <div class="card__content">
                        <a href="{{ route('product.show', $product->id) }}" style="color: inherit;">
                            <h4 class="card__content-name">{{ $product->name }}</h4>
                        </a>
                    </div>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-outline-primary mb-1">Редактировать</a>
                    <form class="product-delete" action="{{ route('product.delete', $product->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            @endforeach
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $('.product-delete').on('click', function () {
          if (!confirm("Вы уверены, что хотите удалить запись?")) {
            event.preventDefault();
          }
      });
    </script>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection