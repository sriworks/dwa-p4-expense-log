@extends('layouts.master')

@section('title')
    Expense Logger
@endsection

@section('content')
    <div>
        @include('shared.message')
    </div>
    
    <h5 class="py-3 text-center">Manage Catagories & Tags</h5>

    <div class="row py-3">
        <div class="col-md-6">
            @include('settings.categories')
        </div>
        <div class="col-md-6">
            @include('settings.tags')
        </div>
    </div>
    
@endsection