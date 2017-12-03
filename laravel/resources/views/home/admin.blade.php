@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Admin functions</div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4>Users</h4>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td>E-mail</td>
                                        <td  style="width: 290px;">Is Manager</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(App\User::where('isAdmin', '!=', 1)->get() as $key => $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td >{{ $value->name }}</td>
                                            <td >{{ $value->email }}</td>
                                            <td class="text-center">
                                            {{ Form::checkbox('ismanager', 1, $value->isManager, ['onclick' =>'update_manager('.$value->id.')']) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id = "answer">

    </div>
    <script>
        function update_manager(user){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'{{route('ajaxmanager')}}',
                data:{'_token':'{{csrf_token()}}', 'id':user},
                success:function(data){
                }
            });
        }
    </script>
@endsection