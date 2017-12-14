@extends('layouts.master')

@section('title')
    Expense Logger
@endsection

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <h5 class="text-center pt-3">Edit your Expense <br/> <span class="text-muted">Please fill in the fields below to update your expense. Fields marked with (<span class="text-danger">*</span>) are mandatory</span></h5>
             @include('expense.create-form', array('expense' => $expense, 'mode'=>'edit', 'form_action'=>'/expense/'.$expense['id']))
        </div>
    </div>
    @include('expense.delete-confirm')
@endsection