@extends('layouts.master')

@section('title')
    Expense Logger
@endsection

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <h5 class="text-center pt-3">Manage Monthly Budget By Category</h5>
            <div class="row justify-content-md-center">
                <div class="card p-3 my-3 col-md-8">
                    @include('budget.create')
                </div>
            </div>
            <table class="table table-secondary table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Budget Category</th>
                        <th scope="col" class="text-center">Monthly Budgeted Amount(In USD)</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($budgets as $budget)
                    <tr>
                        <td>{{ $budget->category->term }}</td>
                        <td class="text-right"><b>{{$budget->monthly_budgeted_amount}}</b></td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                 <button class="btn btn-secondary" data-toggle="modal" data-target="#budgetDeleteConfirmModal"data-category="{{ $budget->category->term }}" data-budgetid="{{$budget->id}}" >Delete</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('budget.delete-confirm')
@endsection