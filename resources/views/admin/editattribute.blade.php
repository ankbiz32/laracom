@extends('layouts.admin')

@section ('content')

    <div class="content-wrapper">
        <div class="content-header my-3">
        <div class="container-fluid">
            <div class="row mb-2 mt-3 px-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Edit Attribute :</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('/admin-attribute')}}">Attribute list</a></li>
                <li class="breadcrumb-item active">Edit Attribute</li>
                </ol>
            </div>
            </div>
        </div>
        </div>

        <section class="content">
            <div class="container-fluid">
            <div class="col-8">
                <div class="card card-body px-sm-3 px-2">
                <form method="POST" action="{{ route('attribute.update',['id'=>$attribute->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-sm-10">
                            <label for="name" class="">{{ __('Attribute') }}</label>
                            <div class="form-group">
                                <div>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $attribute->name}}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="attributeDiv">
                        @if(!empty($attribute->attributeDetail))
                        <?php $i = 0; ?>
                            @foreach($attribute->attributeDetail as $k=>$v)

                                <div class="row form-row attribute_row_{{$k}}" >
                                <input type ="hidden" id="attribute_id_{{$k}}" name ="attr_detail_id[]" value ="{{$v->id}}">
                                    <div class="col-sm-5">
                                        <div class="position-relative form-group">
                                            <label for="attribute_option_{{$k}}" class="">Option Name</label>
                                            <input type="text" id="attribute_option_{{$k}}" name="opt_name[]" class="form-control attribute_option" value="{{ old('name') ?? $v->name}}" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="position-relative form-group">
                                            <label for="attribute_describe_{{$k}}" class="">Description</label>
                                            <input type="text" id="attribute_describe_{{$k}}" name="opt_descr[]" class="form-control attribute_describe" value="{{ old('name') ?? $v->describe}}" />
                                        </div>
                                    </div>
                                    
                                    @if($i != 0)
                                    <div class="col-sm-2">
                                        <div class="position-relative form-group" style="margin-top:30px;">
                                            <a href="javascript:void(0);" class="btn btn-danger" onclick="removeOldOption('attribute_row_{{$k}}','{{$v->id}}');"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <?php $i++; ?>
                            @endforeach
                        @endif
                        <div class="row addRow" >
                            <div class="col-sm-4">
                                <div class="position-relative form-group">
                                    <a href="javascript:void(0);" class="btn btn-info btn-sm" onclick="addMoreOption();"><i class="fa fa-plus"></i> Add more option</a>
                                </div>
                            </div>
                        </div>
                        <input type ="hidden" class="delOldOpt" name ="delOldOpt" value ="">
                    </div>


                    <button type="submit" class="btn btn-primary mr-2 mt-4">UPDATE ATTRIBUTE</button>
                    <a href="{{URL::to('/admin-attribute')}}" class="btn btn-default mr-2 mr-sm-0  mt-4">CANCEL</a>
                </form>
                </div>
            </div>
            </div>
        </section>
    </div>

    <script type="text/javascript">

    function addMoreOption(){

        var tsp = Date.now();

        $('<div class="form-row attribute_row_'+tsp+'"><div class="col-md-5"><div class="position-relative form-group"><label for="attribute_option_'+tsp+'" class="">Option Name</label><input type="text" id="attribute_option_'+tsp+'" name="new_opt_name[]" class="form-control attribute_option" value="" required></div></div><div class="col-md-5"><div class="position-relative form-group"><label for="attribute_describe_'+tsp+'" class="">Description</label><input type="text" id="attribute_describe_'+tsp+'" name="new_opt_descr[]" class="form-control attribute_describe" value=""></div></div><div class="col-md-2"><div class="position-relative form-group mt-30" style="margin-top:30px;"><a href="javascript:void(0);" class="btn btn-danger" onclick="removeOption(\'attribute_row_'+tsp+'\');"><i class="fa fa-trash"></i></a></div></div></div>').insertBefore($(".addRow"));
    }

    function removeOldOption(rowId,dId){
        notie.confirm({ text: 'Are you sure?' }, function() {
            var t=$(".delOldOpt").val();
            if(t==''){
                s=dId;
                $(".delOldOpt").val(s);
            }else{
                s=t+','+dId;
                $(".delOldOpt").val(s)
            }
            $("."+rowId+"").remove();
        })
    }
    function removeOption(rowId,dId){
        notie.confirm({ text: 'Are you sure?' }, function() {
            $("."+rowId+"").remove();
        })
    }
    </script>

@endsection
