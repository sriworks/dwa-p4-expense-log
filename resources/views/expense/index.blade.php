@extends('layouts.master')

@section('title')
    Expense Logger
@endsection

@section('content')
    <h5 class="text-center pt-3">Manage Expenses</h5>
    <div class="row justify-content-md-center">
        <div class="col">
            <table class="table table-secondary table-bordered">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>Expense</th>
                        <th>Transaction Date</th>
                        <th>Amount(USD)</th>
                        <th>Exclude from Budget?</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @foreach($expenses as $expense)
                    <tr>
                        <td>
                            <b>{{ $expense->category->term }}</b>
                            <br/>
                            {{ $expense['memo'] }}
                        </td>
                        <td>
                           {{ Carbon\Carbon::parse($expense->transaction_date)->format('m/d/Y') }}
                        </td>
                        <td class="text-right">
                            {{ $expense['amount'] }}
                        </td>
                        <td>
                            {{ $expense['exclude_from_budget'] == 1 ? 'Yes': 'No' }}
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                 <a class="btn btn-warning" href="/expense/{{$expense['id']}}/edit">Edit</a>
                                 <button class="btn btn-secondary" data-toggle="modal" data-target="#expenseDeleteConfirmModal" data-expenseid="{{$expense['id']}}" data-transactiondate="{{Carbon\Carbon::parse($expense->transaction_date)->format('m/d/Y')}}" data-amount="{{$expense['amount']}}" >Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    @include('expense.delete-confirm')
@endsection