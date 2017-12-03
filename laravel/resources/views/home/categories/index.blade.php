<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <td>Name</td>
        <td style="width: 290px;">Options</td>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $key => $value)
        @php
            $id_grand = DB::table('grand_sub_categories')->select('id_grand')->where('id_sub', $value->id)->first()->id_grand;
        @endphp
        <tr @if($grandcategory = DB::table('grandcategories')->select('name')->where('id', $id_grand)->first() == null) style = "background-color:red;"  @endif>
            <td >{{ $value->name }}</td>
            <td>
                <a class="btn btn-small btn-success" style="min-width: 100px" href="{{ URL::to('categories/' . $value->id) }}">Show</a>
                @if($key != 0)
                    <a class="btn btn-small btn-success" style="min-width: 100px" href="{{ URL::to('categories/' . $value->id . '/edit') }}">Edit</a>
                {{ Form::open(array('url' => 'categories/' . $value->id, 'style' => 'display: inline; min-width: 100px')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>