@extends('layouts.backEnd.layoutBackEnd')
@section('title_page','Product Admin')
@section('title_form','Product')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" enctype="multipart/form-data" id="upRecord_product">
                @csrf
                <div class="card-body">
                   <div class="row">
                       <div class="col-md-6">
                            <div class="form-group">
                                <label id="category_id"> <span class="titleRoot" style="display: inline-block">Category</span> <span class="titleError" style="display: none"></span></label>  
                                <select class="form-control" id="category_idInput"  name="category_id">
                                <option value="">----Choose Category----</option>
                                <?php   showCategories($categoies) ?>
                                </select>
                            </div>
                       </div>
                       <div class="col-md-6">
                            <div class="form-group">
                                <label id="brand_id"> <span class="titleRoot" style="display: inline-block">Brand</span> <span class="titleError" style="display: none"></span></label>  
                                <select class="form-control" name="brand_id"  id="brand_idInput">
                                    <option value="">----Choose Brand----</option>
                                @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                   </div>
                   <div class="row">
                       <div class="col-md-6">
                        <label id="name"> <span class="titleRoot" style="display: inline-block">Name</span> <span class="titleError" style="display: none"></span></label> 
                            <div class="form-group">
                                <input type="text" class="form-control" id="nameInput" placeholder="Enter name Product..." name="name" value="{{old('name')}}">
                            </div>
                       </div>
                       <div class="col-md-6">
                            <label for="">Basic customization</label>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="product_status" value="0" id='category_status'>
                                                <label class="form-check-label" for="category_status">Hide</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" checked name="product_status" value="1" id='category_status2'>
                                                <label class="form-check-label" for="category_status2">Show</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="active_home" value="1" id='active_home'>
                                                <label class="form-check-label" for="active_home">Show home page</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" checked name="active_new" value="1" id='active_new'>
                                                <label class="form-check-label" for="active_new">Show tag new</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                   </div>
                   <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="feature_id"> <span class="titleRoot" style="display: inline-block">Feature</span> <span class="titleError" style="display: none"></span></label>  
                                <select class="form-control" name="feature_id"  id="feature_idInput">
                                    <option value="">----Choose Feature----</option>
                                @foreach ($features as $feature)
                                    <option value="{{$feature->id}}">{{$feature->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                   <div class="row justify-content-end">            
                        <button  type="button" class="btn btn-success" id="addFormRecord"><i class="fas fa-plus mr-1"></i> Add a record</button>
                   </div>
                   <div class="row" id="addRecord">
                        <div class="col-md-12" id="formRecord">
                            <div class="row">
                                <div class="col-md-2">
                                    <label id="color_id_0"> <span class="titleRoot" style="display: inline-block">Color</span> <span class="titleError" style="display: none"></span></label>  
                                    <select class="form-control" name="color_id[]" id="color_id_0Input">
                                        <option value="">----Choose Color----</option>
                                        @foreach ($colors as $color)
                                            <option style="background: {{$color->color_code}} " value="{{$color->id}}">{{$color->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label id="quantity_0"> <span class="titleRoot" style="display: inline-block">Quantity</span> <span class="titleError" style="display: none"></span></label>                
                                    <div class="form-group">
                                        <input class="form-control" type="text"  name="quantity[]" id="quantity_0Input" value="1" min="0" placeholder="Enter quantity  ...">
                                    </div>                        
                                </div>
                                <div class="col-md-2">                             
                                    <label id="price_0"> <span class="titleRoot" style="display: inline-block">Price</span> <span class="titleError" style="display: none"></span></label>                                      
                                    <div class="form-group">
                                        <input class="form-control" type="text"  id="price_0Input" name="price[]" placeholder="Enter price...">
                                    </div>                        
                                </div>
                                <div class="col-md-2">
                                    <label id="price_sale_0"> <span class="titleRoot" style="display: inline-block">Price_sale</span> <span class="titleError" style="display: none"></span></label>           
                                    <div class="form-group">
                                        <input class="form-control" type="text"  id="price_sale_0Input" name="price_sale[]" placeholder="Enter price sale...">
                                    </div>                        
                                </div>
                                <div class="col-md-2">      
                                    <label for="checkok">Show</label>
                                    <label for=""> | </label>
                                    <label for="checker">Hiden</label>                          
                                    <div class="row">
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" checked name="product_detail_status[]" value="1" checked id="checkok" onclick="checkAtive(this.id)">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="product_detail_status[]" value="0" id="checker" onclick="checkAtive(this.id)">
                                                </div>
                                            </div>
                                        </div>    
                                    </div>                   
                                </div>
                                <div class="col-md-1">                               
                                   <div class="row">
                                        <div class="col-md-6">
                                            <label for="" class="label_upload_0">Upload</label>             
                                            <div class="form-group">
                                                <label type="button" class="btn btn-danger attachmentBtn imgae_0_input" name="0"><i class="fas fa-upload"></i></label>
                                                <input type="file" name="imgae[0][]" id="imageUpload" class="attachment0" style="display: none" multiple>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="showImg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Show Images</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="showImage0">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div> 
                                        <div class="col-md-6">
                                            <label for="">Show</label>             
                                            <div class="form-group wp-box-show_0 not-allowed">
                                                <label type="button" class="btn btn-success disabled_show_img btn-show-img_0" data-target="#showImg" data-toggle="modal"><i class="fas fa-images"></i></label>
                                            </div> 
                                        </div>   
                                    </div>                       
                                </div>
                                <div class="col-md-1">                               
                                    <label for="">Tool</label>             
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger" onclick="deleteRec(this.name)" name="formRecord"><i class="fas fa-trash"></i></button>
                                    </div>                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <span  class="btn btn-danger"><span id="quantity_reco">1</span> :product records</span>
                    </div>
                    <div class="row justify-content-center">
                        <div class="form-group col-md-12">
                            <label>Content</label>
                            <textarea name="description" class="form-control " id="editor1"></textarea>
                        </div> 
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" checked name="redirect" value="1" id="redirect">
                          <label class="form-check-label" for="redirect">Redirect to brand index</label>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
{{-- Đệ quy  --}}
<?php   
function showCategories($categories, $parent_id = null, $char = '')
{
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent == $parent_id)
        {
            echo '<option value=" '.$item->id.'">'.'&ensp;'.$char.$item->name.'</option>';
            // Xóa chuyên mục đã lặp
            unset($categories[$key]);
             
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($categories, $item->id, '&ensp;'.$char.'|--');
        }
    }
}

?>
@section('script_cus')
    <script>
        sessionStorage.clear();
        $(document).ready(function(){
            $("#addFormRecord").click(function(){
                $('#quantity_reco').empty();
                if (sessionStorage.clickcounts) {
                    sessionStorage.clickcounts = Number(sessionStorage.clickcounts)+1;
                } else {    
                    sessionStorage.clickcounts = 1;
                }
                numC=$("#addRecord .col-md-12").length+1;
                html='<div class="col-md-12 mt-3" id="formRecord_'+sessionStorage.clickcounts+'">';
                html+=' <div class="row">';
                // htm
                html+='<div class="col-md-2"><label id="color_id_'+sessionStorage.clickcounts+'"> <span class="titleRoot" style="display: inline-block">Color</span> <span class="titleError" style="display: none"></span></label> <select class="form-control" name="color_id[]" id="color_id_'+sessionStorage.clickcounts+'Input"><option value="">----Choose Color----</option>@foreach ($colors as $color)<option style="background: {{$color->color_code}} " value="{{$color->id}}">{{$color->name}}</option>@endforeach</select></div>';
                html+='<div class="col-md-2"><label id="quantity_'+sessionStorage.clickcounts+'"> <span class="titleRoot" style="display: inline-block">Quantity</span> <span class="titleError" style="display: none"></span></label> <div class="form-group"><input class="form-control" type="text"  name="quantity[]" id="quantity_'+sessionStorage.clickcounts+'Input" value="1" min="0" placeholder="Enter quantity  ..."></div></div>';
                html+='<div class="col-md-2"><label id="price_'+sessionStorage.clickcounts+'"> <span class="titleRoot" style="display: inline-block">Price</span> <span class="titleError" style="display: none"></span></label><div class="form-group"><input class="form-control"  id="price_'+sessionStorage.clickcounts+'Input" type="text"  name="price[]" placeholder="Enter price..."></div> </div>';
                html+='<div class="col-md-2"> <label id="price_sale_'+sessionStorage.clickcounts+'"> <span class="titleRoot" style="display: inline-block">Price_sale</span> <span class="titleError" style="display: none"></span></label> <div class="form-group"><input class="form-control" type="text" id="price_sale_'+sessionStorage.clickcounts+'Input" name="price_sale[]" placeholder="Enter price sale..."></div>  </div>';
                html+='<div class="col-md-2"> <label for="checkok_'+sessionStorage.clickcounts+'">Show&nbsp</label><label for=""> | </label><label for="checker_'+sessionStorage.clickcounts+'">&nbspHiden</label>  <div class="row"><div class="col-md-3"><div class="form-group"><div class="form-check"><input class="form-check-input" type="checkbox" checked name="product_detail_status[]" value="1"  id="checkok_'+sessionStorage.clickcounts+'" onclick="checkAtive(this.id)"></div></div></div>';
                html+='<div class="col-md-2"><div class="form-group"><div class="form-check"><input class="form-check-input" type="checkbox"  name="product_detail_status[]" value="0" id="checker_'+sessionStorage.clickcounts+'" onclick="checkAtive(this.id)"></div></div></div> </div> </div> ';
                html+='<div class="col-md-1"><div class="modal fade" id="showImg'+sessionStorage.clickcounts+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">Show Images</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="showImage'+sessionStorage.clickcounts+'"></div></div></div></div></div> <div class="row"><div class="col-6"><label class="label_upload_'+sessionStorage.clickcounts+'">Upload</label> <div class="form-group"><label type="button" class="btn btn-danger attachmentBtn imgae_'+sessionStorage.clickcounts+'_input" name="'+sessionStorage.clickcounts+'"><i class="fas fa-upload"></i></label><input type="file" name="imgae['+sessionStorage.clickcounts+'][]" id="imageUpload'+sessionStorage.clickcounts+'" class="attachment'+sessionStorage.clickcounts+'" style="display: none" multiple></div> </div><div class="col-6"><label for="">Show</label> <div class="form-group wp-box-show_'+sessionStorage.clickcounts+' not-allowed"><label type="button" class="btn btn-success disabled_show_img btn-show-img_'+sessionStorage.clickcounts+'" data-target="#showImg'+sessionStorage.clickcounts+'" data-toggle="modal"><i class="fas fa-images"></i></label></div> </div></div></div>';
                html+='<div class="col-md-1"><label for="">Tool</label><div class="form-group"><button type="button" class="btn btn-danger" onclick="deleteRec(this.name)" name="formRecord_'+sessionStorage.clickcounts+'"><i class="fas fa-trash"></i></button></div></div>';
                html+='</div>';
                html+='</div>';
                $("#addRecord").append(html);
                $('#quantity_reco').text(numC);
            });
        });
    </script>
@endsection