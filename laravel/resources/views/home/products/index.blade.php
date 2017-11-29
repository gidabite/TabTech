<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Options</td>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td >{{ $value->name }}</td>
            <td style="max-width: 50px">
                <a class="btn btn-small btn-success" style="min-width: 100px" href="{{ URL::to('products/' . $value->id) }}">Show</a>
                <a class="btn btn-small btn-success" style="min-width: 100px" href="{{ URL::to('products/' . $value->id . '/edit') }}">Edit</a>
                {{ Form::open(array('url' => 'products/' . $value->id, 'style' => 'display: inline; min-width: 100px')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>