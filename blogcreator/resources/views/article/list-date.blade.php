<h2>By dates</h2>
<div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <tr>
                <th> Years </th>
            </tr>
        </thead>
        <tbody>
        @foreach($years as $year => $foo)
            <tr>
                <td><a href="{{ url('/categorie/' . $year) }}" title="View Categorie">{{ $year }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <tr>
                <th> Months </th>
            </tr>
        </thead>
        <tbody>
        @foreach($months as $month => $foo)
            <tr>
                <td><a href="{{ url('/categorie/' . $month) }}" title="View Categorie">{{ $month }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>