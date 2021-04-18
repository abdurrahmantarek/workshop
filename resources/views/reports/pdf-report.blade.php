<style>

    table {
        margin: 0 auto;
    }

    table {
        color: #333;
        background: white;
        border: 1px solid grey;
        font-size: 12pt;
        border-collapse: collapse;
    }
    table thead th,
    table tfoot th {
        color: #777;
        background: rgba(0,0,0,.1);
    }
    table th,
    table td {
        padding: .5em;
        border: 1px solid lightgrey;
        text-align: center;
    }

</style>


<h1>Tweets Report</h1>

<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Number of Tweets</th>
    </tr>
    </thead>
    <tbody>
    @forelse($usersWithCountedTweets AS $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->tweets_count }}</td>
        </tr>
    @empty
        <h3>No Users :( </h3>
    @endforelse
</table>


<p>The average number of tweets per users is : {{ number_format($totalTweets / $totalUsers, 2, '.', '')}}</p>



