@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <div class="row">
                            <div class="col-lg-2"><a href="{{URL::to('home')}}" class="pull-left btn btn-sm">Back to home</a>
                            </div>
                            <span class="col-lg-4 col-lg-offset-2">
                                New Subategory
                            </span>
                        </div>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(array('url' => 'categories')) }}
                            <div class="input-group">
                                <span class="input-group-addon" id="name-category">Subcategory name</span>
                                {{Form::text('name', null, array('class' => 'form-control', 'aria-describedby' => 'name-category', 'placeholder' => 'Enter subcategory name', 'required'))}}
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon" id="name-category">Category name</span>
                                @php
                                    $granscategories = DB::table('grandcategories')->pluck ('name');
                                    $assoc = array_combine($granscategories->toArray(),$granscategories->toArray());
                                @endphp
                                {{Form::select('grandcategory', $assoc, old('grandcategory'), array('placeholder' => 'Please select a grandcategory', 'class' => 'form-control ','aria-describedby' => 'category', 'required'))}}
                            </div>
                            <hr>
                            <h4>Characteristics</h4>
                            <div id="characteristics">

                            </div>
                            <div class="row">
                                {{ Form::button('Add characteristic', array('class' => 'col-lg-6 col-lg-offset-3 btn btn-primary', 'onClick' => 'addCharacteristic()')) }}
                            </div>
                            <hr>
                            {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var currList = [];
        var countC = 0;
        function changeSelect(id){
            if ($('#select'+id).val() == 'list'){
                if (currList[id] == "") {
                    $('#sel' + id).html('<div  class="row">' +
                        '                   <div class="col-lg-8 col-lg-offset-2">\n' +
                        '                       <h5>List elements</h5>' +
                        '                   </div>' +
                        '              </div>' + currList[id] +
                        '              <div class="row">\n' +
                        '                   <button class="col-lg-6 col-lg-offset-3 btn btn-primary" onclick=addElement(' + id + ') type="button">Add element</button>' +
                        '              </div><br>');
                } else $('#sel' + id).html(currList[id]);
            } else {
                currList[id] = $('#sel'+id).html();
                $('#sel'+id).html('');
            }
        }
        function addElement(id) {
            var countE = $('#count'+id).val();
            $('#sel'+id).append('<div class="row">\n' +
                '                               <div class="col-lg-8 col-lg-offset-2">\n' +
                '                                   <div class="input-group">' +
                '                                       <span style="min-width: 50px;" id="spansel' + id + '" class="input-group-addon">' +
                '                                            ' + (+countE + 1) +
                '                                       </span>' +
                '                                       <input aria-describedby="spansel' + id + '" placeholder="Enter element" name="elem_' + id + '_' + countE + '" type="text" class="form-control">' +
                '                                   </div>' +
                '                               </div>' +
                '                           </div>');
            $('#count'+id).val(+countE + 1);
        }
        function addCharacteristic(){
            $('#characteristics').append('<div class="panel panel-default">' +
                    '                <div class="panel-body">' +
                    '                <input type="hidden" name="count' + countC + '" id="count' + countC + '" value ="0">'+
                    '                   <div class="row">' +
                    '                       <div class="col-lg-6">' +
                    '                           <div class="input-group">' +
                    '                               <span class="input-group-addon" id="sizing-addon2">Characteristic name</span>' +
                    '                               <input class="form-control" aria-describedby="sizing-addon2" placeholder="Enter characteristic name" name="char' + countC + '" type="text">' +
                    '                           </div>' +
                    '                       </div>' +
                    '                       <div class="col-lg-6">' +
                    '                           <select id="select' + countC + '" onchange="changeSelect(' + countC + ')" name="select' + countC + '" class="form-control">' +
                    '                               <option value="text">Text</option>' +
                    '                               <option value="list">List</option>' +
                    '                           </select>' +
                    '                       </div>' +
                    '                   </div>' +
                    '               <div id = "sel' + countC + '">' +
                    '               </div>' +
                    '           </div>' +
                    '       </div>');
            currList.push("");
            countC = countC + 1;
        }
    </script>
@endsection