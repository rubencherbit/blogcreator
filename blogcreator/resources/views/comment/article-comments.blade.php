<div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <tr>
                <th> User </th><th> Date </th><th> Content </th>
            </tr>
        </thead>
        <tbody>
        @foreach($comments as $item)
            <tr>
                <td>{{ $item->user->name }}</td><td>{{ $item->created_at }}</td><td>{{ $item->content }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper"> {!! $comments->render() !!} </div>
</div>