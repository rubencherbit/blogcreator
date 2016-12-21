<div class="table-responsive">
    <table class="table table-borderless">
        <h2>Articles
            {{ isset($date) ? "for $date" : ''}}
            {{ isset($categorie) ? "for $categorie->name" : ''}}
        </h2>
        <thead>
            <tr>
                <th> Title </th><th> Categorie </th><th> Author </th><th> Post date </th>
            </tr>
        </thead>
        <tbody>
        @foreach($articles as $item)
            <tr>
                <td><a href="{{ url('/article/' . $item->id) }}" title="View Article">{{ $item->title }}</a></td>
                <td>
                    @if (isset($item->categorie->name))
                    <a href="{{ url('/categorie/' . $item->categorie->id) }}" title="View Categorie">{{ $item->categorie->name }}</a>
                    @else
                    No categorie
                    @endif
                </td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>