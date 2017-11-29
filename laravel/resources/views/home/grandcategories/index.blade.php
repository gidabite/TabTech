<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <td style="width: 200px">Name</td>
        <td style="width: 400px">Description</td>
        <td>Options</td>
    </tr>
    </thead>
    <tbody>
    @foreach($grandcategories as $key => $value)
        <tr>
            <td>{{ $value->name }}</td>
            <td >{{ $value->description }}</td>
            <td style="max-width: 50px">
                <a class="btn btn-small btn-success" style="min-width: 100px" href="{{ URL::to('grandcategories/' . $value->id) }}">Show</a>
                <a class="btn btn-small btn-success" style="min-width: 100px" href="{{ URL::to('grandcategories/' . $value->id . '/edit') }}">Edit</a>
                {{ Form::open(array('url' => 'grandcategories/' . $value->id, 'style' => 'display: inline; min-width: 100px')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>