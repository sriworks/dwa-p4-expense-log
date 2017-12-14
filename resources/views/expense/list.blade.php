<table class="table table-secondary table-bordered">
<thead class="thead-dark">
    <tr class="text-center">
        <th class="col-sm-6">Expense</th>
        <th>Transaction Date</th>
        <th>Amount(USD)</th>
        @if($mode != 'small')
            <th>Exclude from Budget?</th>
            <th>Actions</th>
        @endif
    </tr>
</thead>
@foreach($expenses as $expense)
    <tr>
        <td class="text-left">
            <b>{{ $expense->category->term }}</b><br/>
            <span class="font-italic">{{ $expense['memo'] }}</span>
            @if($mode != 'small')
            <br/><strong>Tags:</strong> 
                @foreach($expense->tags as $tag)
                    <a href="/expense?tag={{$tag->id}}" class="badge badge-light">{{$tag->term}}</a>
                @endforeach
            @endif
        </td>
        <td>
           {{ Carbon\Carbon::parse($expense->transaction_date)->format('m/d/Y') }}
        </td>
        <td class="text-right">
            {{ $expense['amount'] }}
        </td>
        @if($mode != 'small')
            <td>
                {{ $expense['exclude_from_budget'] == 1 ? 'Yes': 'No' }}
            </td>

            <td class="text-center">
                <div class="btn-group" role="group">
                     <a class="btn btn-warning" href="/expense/{{$expense['id']}}/edit">Edit</a>
                     <button class="btn btn-danger" data-toggle="modal" data-target="#expenseDeleteConfirmModal" data-expenseid="{{$expense['id']}}" data-transactiondate="{{Carbon\Carbon::parse($expense->transaction_date)->format('m/d/Y')}}" data-amount="{{$expense['amount']}}" >Delete</button>
                </div>
            </td>
        @endif
    </tr>
@endforeach
</table>