@extends('layouts.backEnd.layoutBackEnd')
@section('title_page','Config Admin')
@section('title_form','Config')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Config Edit</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{route('configPage.updateInfo',$configPage->id)}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        @error('name')
                            <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i>{{$message}}</label>
                        @else
                            <label for="">Name</label>
                        @enderror
                        <input type="text" class="form-control" placeholder="Enter address" name="name" value="Info " disabled>
                    </div>
                    <div class="form-group">
                        @error('address')
                            <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i>{{$message}}</label>
                        @else
                            <label for="">Address</label>
                        @enderror
                        <input type="text" class="form-control @error('address') is-invalid  @enderror " placeholder="Enter address" name="address" value="{{$configPage->address}}">
                    </div>
                    <div class="form-group">
                        @error('phone')
                            <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i>{{$message}}</label>
                        @else
                            <label for="">Phone</label>
                        @enderror
                        <input type="text" class="form-control @error('phone') is-invalid  @enderror " placeholder="Enter phone..." name="phone" value="{{$configPage->phone}}">
                    </div>
                    <div class="form-group">
                        @error('email')
                            <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i>{{$message}}</label>
                        @else
                            <label for="">Email</label>
                        @enderror
                        <input type="email" class="form-control @error('email') is-invalid  @enderror " placeholder="Enter email..." name="email" value="{{$configPage->email}}">
                    </div>
              
                    <div class="form-group">
                        @error('openTime')
                            <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i>{{$message}}</label>
                        @else
                            <label for="">Opentime</label>
                        @enderror
                        <input type="text" class="form-control @error('openTime') is-invalid  @enderror " placeholder="Enter openTime..." name="openTime" value="{{$configPage->email}}">
                    </div>
                    <div class="row">
                        <div class="col md-6">
                             <div class="form-group">
                                 <div class="form-check">
                                     <input class="form-check-input" type="radio" name="status" value="0" id='category_status' @if ($configPage->status==0)
                                         checked
                                     @endif>
                                     <label class="form-check-label" for="category_status">Hide</label>
                                 </div>
                           </div>
                        </div>
                        <div class="col md-6">
                         <div class="form-group">
                             <div class="form-check">
                                 <input class="form-check-input" type="radio"  name="status" value="1" id='category_status2'
                                 @if ($configPage->status==1)
                                         checked
                                     @endif>
                                 <label class="form-check-label" for="category_status2">Show</label>
                             </div>
                       </div>
                    </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
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
{{-- ????? quy  --}}
<?php   
function showCategories($categories, $parent_id = null, $char = '')
{
    foreach ($categories as $key => $item)
    {
        // N???u l?? chuy??n m???c con th?? hi???n th???
        if ($item->parent == $parent_id)
        {
            echo '<option value=" '.$item->id.'">'.'&ensp;'.$char.$item->name.'</option>';
            // X??a chuy??n m???c ???? l???p
            unset($categories[$key]);
             
            // Ti???p t???c ????? quy ????? t??m chuy??n m???c con c???a chuy??n m???c ??ang l???p
            showCategories($categories, $item->id, '&ensp;'.$char.'|--');
        }
    }
}

?>