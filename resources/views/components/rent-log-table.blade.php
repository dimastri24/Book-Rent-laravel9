@inject('carbon', 'Carbon\Carbon')
<style>
    .return-punct {
        background-color: aquamarine;
        color: green;
    }

    .return-late {
        background-color: lightpink;
        color: firebrick;
    }

    .return-over {
        background-color: khaki;
        color: darkgoldenrod;
    }
</style>
{{-- {{$carbon::now()->toDateString()}} --}}
<div>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>User</th>
                <th>Book</th>
                <th>Rent Date</th>
                <th>Return Date</th>
                <th>Actual Return Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentlogs as $item)
            {{-- <tr class="{{ $item->actual_return_date == null ? '' : 
                ($item->return_date < $item->actual_return_date ? 'return-late' : 'return-punct') }}"> --}}
            <tr class="{{ $item->actual_return_date == null && $item->return_date < $carbon::now()->toDateString() ? 'return-over' : 
                ($item->return_date < $item->actual_return_date ? 'return-late' : 
                ($item->actual_return_date == null ? ''  : 'return-punct') ) }}">
                <td>{{$loop->iteration}}</td>
                <td>{{$item->user->username}}</td>
                <td>{{Str::limit($item->book->title, 35, '...')}}</td>
                <td>{{$item->rent_date}}</td>
                <td>{{$item->return_date}}</td>
                <td>{{$item->actual_return_date}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if ($paginate == true)
    <div class="mt-5">
        {{$rentlogs->withQueryString()->links()}}
    </div>

    @endif
</div>