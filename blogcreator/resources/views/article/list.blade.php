<div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <tr>
                <th> Title </th><th> Categorie </th><th> Author </th><th> Post date </th>
            </tr>
        </thead>
        <tbody>
        @foreach($articles as $item)
            <tr>
                <td><a href="{{ url('/article/' . $item->id) }}" title="View Article">{{ $item->title }}</a></td>
                <td>{{ (isset($item->categorie->name)) ? $item->categorie->name : 'No categorie' }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>