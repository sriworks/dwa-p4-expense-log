@extends('layouts.master')

@section('title')
    Expense Logger
@endsection

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <h5 class="text-center pt-3">Edit your Expense</h5>
             @include('expense.create-form', array('expense' => $expense, 'mode'=>'edit', 'form_action'=>'/expense/'.$expense['id']))
        </div>
    </div>
@endsection