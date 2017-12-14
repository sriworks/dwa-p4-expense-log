<form method="POST" action="{{$form_action}}" class="py-5">
    {{ csrf_field() }}
    @if($mode == 'edit')
        {{ method_field('put') }}
    @endif
    <div class="form-group">
        <label for="category">Expense Category<span class="text-danger">*</span></label>
        <?php $selected_category = $expense['category_id']; ?>
        <select class="form-control" id="category_id" name="category_id" >
            @foreach ($categories as $category)
                <option value="{{$category['id']}}" @if($selected_category == $category['id']) {{'selected'}} @endif >
                    {{$category['term']}}
                </option>
            @endforeach
        </select>
         @include('shared.error-field', ['fieldName' => 'category'])
    </div>
    
    <div class="form-group">
        <label for="transaction_date">Transaction Date<span class="text-danger">*</span></label>
        <input type="text" name="transaction_date" class="form-control" id="transaction_date" placeholder="Transaction Date(mm/dd/yyyy)"  value="{{ $expense['transaction_date'] }}" required>
        @include('shared.error-field', ['fieldName' => 'transaction_date'])
    </div>
    
    <div class="form-group">
        <label for="amount">Expense Amount In USD<span class="text-danger">*</span></label>
        <input type="text" name="amount" class="form-control" id="amount" placeholder="Amount" value="{{ $expense['amount'] }}"  required>
        @include('shared.error-field', ['fieldName' => 'amount'])
    </div>
    
    <div class="form-group">
        <label for="memo">Memo</label>
        <input type="text" class="form-control" id="memo" name="memo" placeholder="Memo" value="{{ $expense['memo'] }}">
        @include('shared.error-field', ['fieldName' => 'memo'])
    </div>
    
    <div class="form-group">
        <?php $selected_tags = $expense['tags']; ?>
        <label for="expense_tag_select">Tags</label>
        <select class="form-control" id="expense_tag_select" name="tags[]" multiple="multiple">
            @foreach ($tags as $tag)
                <option value="{{$tag['id']}}" @if($selected_tags->contains($tag['id'])) {{'selected'}} @endif>{{$tag['term']}}</option>
            @endforeach
        </select>
    </div>
    
    <div class="checkbox">
        <label>
            <input type="checkbox" id="exclude_from_budget" name="exclude_from_budget" value="1"
                @if(isset($expense['exclude_from_budget']) && $expense['exclude_from_budget'] ==1)
                    checked
                @endif
            > Exclude from Budget?
        </label>
        @include('shared.error-field', ['fieldName' => 'exclude_from_budget'])
    </div>
    <div class="py-2">
        <div class="float-right">
            <a class="btn btn-secondary" href="/expense">Cancel</a>
            <input type="submit" class="btn btn-primary" value="Save Expense"/>
        </div>    
        <div class="text-left">
            @if($mode == 'edit')
                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#expenseDeleteConfirmModal" data-expenseid="{{$expense['id']}}" data-transactiondate="{{Carbon\Carbon::parse($expense['transaction_date'])->format('m/d/Y')}}" data-amount="{{$expense['amount']}}" >Delete This Expense</button>
            @endif
        </div>
    </div>

</form>