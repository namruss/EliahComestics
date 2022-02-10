@extends('layouts/frontEnd/layoutFrontEnd2')
@section('titleWeb',"Eliah")
@section('titlePage','Contact')
@section('content')
    <div class="wp-container container" id="contacttop">
        <div class="row">
            <div class="t_ctt col-md-5" >
                <h2>Contact info</h2>
                <div class="cti">
                    <div class="iconct">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="textct">
                        <h5><b>Address</b></h5>
                        @if ($configInfor!=null)
                        <p>{{$configInfor->address}}</p>
                    @endif
                    </div>
                </div>
                <div class="cti">
                    <div class="iconct">
                        <i class="fas fa-headphones"></i>
                    </div>
                    <div class="textct">
                        <h5>Phone</h5>
                        @if ($configInfor!=null)
                        <p>{{$configInfor->phone}}</p>
                    @endif
                    </div>
                </div>
                <div class="cti">
                    <div class="iconct">
                        <i class="far fa-envelope"></i>
                    </div>
                    <div class="textct">
                        <h5>Email</h5>
                        @if ($configInfor!=null)
                        <p>{{$configInfor->email}}</p>
                    @endif
                    </div>
                </div>
                <div class="cti">
                    <div class="iconct">
                        <i class="far fa-clock"></i>
                    </div>
                    <div class="textct">
                        <h5>Opentime</h5>
                        @if ($configInfor!=null)
                        <p>{{$configInfor->openTime}}</p>
                    @endif
                    </div>
                </div>
            </div>
            <div class="t_git col-md-7">
                <h2>Get in touch</h2>
                <br>
                <label id="name_title" class="inputAll" style="display: none; color:red"></label>
                <input type="text" name="name" id="name" placeholder=" Name">
                <br>
                <label  id="email_title" class="inputAll" style="display: none; color:red"></label>
                <input type="email" name="email" id="email" placeholder=" Email">
                <br>
                <label id="content_title" class="inputAll" style="display: none; color:red"></label>
                <textarea name="content" id="content" cols="20" rows="5" placeholder=" Message"></textarea>
                <br>
                <button onclick="postContact()">SEND MESSAGE</button>
            </div>
        </div>
    </div>
    <div class="wp-container container" id="contactbot">
        <div class="t_ctmap col-md-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.9413902266087!2d105.85958811476262!3d20.994986386016574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac0fd68adf91%3A0x3f11712e71a7b04d!2sVTC%20Academy!5e0!3m2!1svi!2s!4v1623828392829!5m2!1svi!2s" width="100%" height="600px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>        </div>
    </div>
@endsection
@section('script_cus')
    <script>
        function postContact(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            name=$('#name').val();
            email=$('#email').val();
            content=$('#content').val();
            $.ajax({
                url:'ContactPost',
                type:'POST',
                dataType:'JSON',
                data: {
                    "name": name,
                    'email':email,
                    'content':content
                },
                success: function(data) {
                    if(data!=null){
                        Command: toastr[data.title](data.message_alert);
                        $('.inputAll').val('');
                    }
                },
                error: function(error){
                    objects=error.responseJSON.errors;
                    $('.inputAll').css('display','none');            
                    for(var key in objects) {
                        title='#'+key+'_title';
                        $(title).text(objects[key][0]);
                        $(title).css('display','inline-block');
                    }
                }
            });
        }
    </script>
@endsection