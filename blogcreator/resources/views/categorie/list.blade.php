<div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <h2>Categories</h2>
            <tr>
                <th> Name </th>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $item)
            <tr>
                <td><a href="{{ url('/categorie/' . $item->id) }}" title="View Categorie">{{ $item->name }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>