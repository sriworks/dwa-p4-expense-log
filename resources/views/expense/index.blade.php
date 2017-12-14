@extends('layouts.master')

@section('title')
    Expense Logger
@endsection

@section('content')
    <h5 class="text-center pt-3">Manage Expenses</h5>
    <div class="row justify-content-md-center">
        <div class="col">
            @include('expense.list', array('mode'=>'full'))
        </div>
    </div>
    @include('expense.delete-confirm')
@endsection