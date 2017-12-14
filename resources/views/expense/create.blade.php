@extends('layouts.master')

@section('title')
    Expense Logger
@endsection

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <h5 class="text-center pt-3">Log New Expense <br/> <span class="text-muted">Please fill in the fields below to log your expense. Fields marked with (<span class="text-danger">*</span>) are mandatory</span></h5>
            
            <?php $expense = array(
                    'category_id' => old('category_id', ''),
                    'transaction_date' => old('transaction_date', ''),
                    'amount' => old('amount'),
                    'memo' => old('memo'),
                    'tags' => collect(old('tags')), ); ?>
            @include('expense.create-form', array('expense' => $expense, 'mode'=>'create', 'form_action'=>'/expense'))
        </div>
    </div>
@endsection