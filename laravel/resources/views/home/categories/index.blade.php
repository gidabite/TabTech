<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Options</td>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td >{{ $value->name }}</td>
            <td style="max-width: 50px">
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