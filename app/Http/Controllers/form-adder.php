
<div class="container lst">
    <div class="input-group hdtuto control-group lst increment" >
    <input type="file" name="filenames[]" class="myfrm form-control">
    <div class="input-group-btn">
    <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
    </div>
    </div>

    <div class="clone hide" hidden>
    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
    <input type="file" name="filenames[]" class="myfrm form-control">
    <div class="input-group-btn">
    <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
    </div>
    </div>
    </div>
</div>

<script>
    $(".btn-success").click(function(){
        var lsthmtl = $(".clone").html();
        $(".increment").after(lsthmtl);
    });

    $("body").on("click",".btn-danger",function(){
        $(this).parents("div.hdtuto").remove();
    });
</script>
