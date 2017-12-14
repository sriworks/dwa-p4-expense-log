@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row justify-content-md-center align-items-top py-3">
            <div class="col-md-6 card border-light bg-light text-center">
                <h4 class="card-title">Budget Trends This Month</h4>
                @include('dashboard.budget-trends')
            </div>
            <div class="col-md-6 card border-light bg-light  text-center">
                <h4 class="card-title">Top Expenses This Month</h4>
                @include('expense.list', array('mode'=>'small'))
                <a href="/expense">View All Expenses</a>
            </div>
    </div>
    <div class="row justify-content-md-center align-items-top py-3">
                    <div class="col-md-8 card border-light bg-light text-center">
                <h4 class="card-title">Expense Trends This Year</h4>
                @include('dashboard.expense-trends')
            </div>
        
    </div>
    
@endsection