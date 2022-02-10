@extends('layouts.backEnd.layoutBackEnd')
@section('title_page','Product Admin')
@section('title_form','Product')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Product is out of stock</strong></h3>
      </div>
      <br>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-2">
        <table class="table text-nowrap" id="myTable">
          <thead>
            <tr class="text-center">
              <th>STT</th>
              <th>Name</th>
              <th>Color</th>
              <th>Quantity</th>
              <th>Tools</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($productQuantitys as $productQuantity)
                <tr class="text-center">
                    <td>{{$loop->index+1}}</td>
                    <td>{{$productQuantity->product->name}}</td>
                    <td>
                        @if ($productQuantity->color_id!=null)
                            <span class="color_show" style="background:{{$productQuantity->color->color_code}};margin:0 auto"></span>
                        @else
                        <span>No color</span>
                        @endif
                      
                    </td>
                    <td>{{$productQuantity->quantity}}</td>
                    <td>
                      <form action="" method="POST">
                            <a href="{{route('productDetail.edit',$productQuantity->id)}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                        </form>
                    </td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div> 
</div>
@endsection
@if (Session::has('success'))
    @section('alert')
        <script>
          Command: toastr["success"]("{{Session::get('success')}}")
        </script>
    @endsection
@endif
@if (Session::has('error'))
    @section('alert')
        <script>
          Command: toastr["error"]("{{Session::get('error')}}")
        </script>
    @endsection
@endif