<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tree</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>
<body>

<div class="container">
    <div class="content">
<ul class="list-group" id="tree">
    @foreach($comtrees as $item)
        {{--{!!$item->parent == 2?"<ul>":""!!}
        {!!$item->id != $item->parent?"<ul>":""!!}--}}
        <li id="{{$item->id}}" class="list-group-item" parent="{{$item->parent}}" amount="{{$item->amount}}" total_amount="{{$item->total_amount}}">
            <label>
                {{--<input type="checkbox" /> --}}id:{!!$item->id!!} | name:{!!$item->name!!} | amount:{!!$item->amount!!} |{{-- total amount from base:{!!$item->total_amount!!}--}} parent:{!!$item->parent!!}
            </label>
        </li>
      {!!"<ul id='ul".$item->id."'></ul>"!!}
       {{--{!!$item->parent == 2?"</ul>":""!!}--}}
    @endforeach
</ul>

        <form action="{{ url('/add')}}" method="POST" class="form-inline">
            {{ csrf_field() }}

          {{--  name:<input type="text" name="name">
            amount: <input type="text" name="amount">
            total_amount: <input type="text" name="total_amount">
            parent: <input type="text" name="parent">--}}

            <div class="form-group">
                <label for="iput_name">Name</label>
                <input type="text" class="form-control" id="input_name" placeholder="Company" name="name">
            </div>
            <div class="form-group">
                <label for="input_amount">Amount</label>
                <input type="text" class="form-control" id="input_amount" placeholder="0" name="amount">
            </div>
           {{-- <div class="form-group">
                <label for="input_total_amount">Total amount</label>
                <input type="text" class="form-control" id="input_total_amount" placeholder="0" name="total_amount">
            </div>--}}
            <div class="form-group">
                <label for="input_parent">Parent</label>
                <input type="text" class="form-control" id="input_parent" placeholder="1" name="parent">
            </div>

            <button type="submit" class="btn btn-default">Send</button>
        </form>



        </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
{{--
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
--}}
<script type="text/javascript">


    var li_length = $('.list-group-item').length;
    function tree_builder(){
        for( var i=1;i<=li_length;i++) {
            var parent = $('#' + i).attr('parent');

                if (i != parent) {
                    $("#" + i)
                    .appendTo("#ul" + parent);
                    $("#ul" + i)
                    .appendTo("#ul" + parent);
                }
        }
    }
    tree_builder();
    function total(id){
           var our_amount = Number($('#' + id).attr('amount'));
           var total_amount_id = Number(our_amount);
          /* var our_parent = $('#' + id).attr('parent');*/
            var our_parent = id;
                    for(var idj = 1; idj<=li_length; idj++){
                       if(idj!=our_parent){
                        var id_parent = $('#' + idj).attr('parent');
                        var id_amount = Number($('#' + idj).attr('total_amount'));
                            if(id_parent==our_parent){
                                /*console.log("amount:"+id_amount);*/
                                total_amount_id = Number(total_amount_id + id_amount);
                            }
                        }
                    }
            /*console.log("our_parent:"+our_parent);
            console.log("our_amount:"+our_amount);
            console.log("total:"+total_amount_id);*/
        return total_amount_id;
        }
    function total_add(i){
            $("#"+i).append( "<label>| total calc:"+total(i)+"</label>" );
            $("#"+i).attr("total_amount", total(i));
    }
    function first_add(){
        for(var i = 1;i<=li_length;i++){
            var our_parent = $('#' + i).attr('parent');
            var our_parent_length =$('.list-group-item[parent="'+i+'"]').length;
            if(i != our_parent){
                if(our_parent_length == 0){
                    total_add(i);
                }
            }
        }
         for(var i2 = 1;i2<=li_length;i2++){
             var our_parent2 = $('#' + i2).attr('parent');
             var our_parent_length2 =$('.list-group-item[parent="'+i2+'"]').length;
            if(i2 != our_parent2){
               if(our_parent_length2 > 0){
                   total_add(i2);
               }
            }
         }
        for(var i3 = 1;i3<=li_length;i3++){
            var our_parent3 = $('#' + i3).attr('parent');
            var our_parent_length3 = $('.list-group-item[parent="'+i3+'"]').length;
            if(i3==our_parent3) {
                total_add(i3)
            }
        }
    }
    first_add()
</script>
</body>
</html>