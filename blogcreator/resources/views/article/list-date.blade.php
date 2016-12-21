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
                <td><a href="{{ url('blog/' . $curr_blog->id . '/article/by-year/' . $year) }}" title="View Articles by Year">{{ $year }}</a></td>
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
                <td><a href="{{ url('blog/' . $curr_blog->id . '/article/by-month/' . $month) }}" title="View Articles by Month">{{ $month }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>