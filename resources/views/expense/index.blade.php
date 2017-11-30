@extends('layouts.master')

@section('title')
    Expense Logger
@endsection

@section('content')
    <div>
        @include('expense.chart')
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Current Expenses</h2>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <tr>
                    <th>Expense</th>
                    <th>Transaction Date</th>
                    <th>Amount</th>
                    <th>Exclude from Budget?</th>
                </tr>
                @foreach($expenses as $expense)
                    <tr>
                        <td>
                            <b>{{ $expense['category'] }}</b>
                            <br/>
                            {{ $expense['memo'] }}
                        </td>
                        <td>
                           {{ date($expense['transaction_date']) }}
                        </td>
                        <td>
                            {{ $expense['amount'] }}
                        </td>
                        <td>
                            {{ $expense['options']['exclude_from_budget'] == 'Yes' ? 'Yes': 'No' }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection