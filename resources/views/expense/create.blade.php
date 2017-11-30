<div class="row">
    <div class="col-md-6 center col-md-offset-3">
        <h3>Log your Expense</h3>
        <form method="POST">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="category">Expense Category<span class="text-danger">*</span></label>
                <?php $selected_category = old('category', ''); ?>
                <select class="form-control" id="category" name="category" >
                    @foreach (config('expense.categories') as $key => $value)
                        <option value="{{$key}}" @if($selected_category == $key) {{'selected'}} @endif >
                            {{$value}}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="transaction_date">Transaction Date<span class="text-danger">*</span></label>
                <input type="text" name="transaction_date" class="form-control" id="transaction_date" placeholder="Transaction Date(mm/dd/yyyy)"  value="{{ old('transaction_date') }}" required>
                @include('shared.error-field', ['fieldName' => 'transaction_date'])
            </div>
            
            <div class="form-group">
                <label for="amount">Expense Amount In USD<span class="text-danger">*</span></label>
                <input type="text" name="amount" class="form-control" id="amount" placeholder="Amount" value="{{ old('amount') }}"  required>
                @include('shared.error-field', ['fieldName' => 'amount'])
            </div>
            
            <div class="form-group">
                <label for="memo">Memo</label>
                <input type="text" class="form-control" id="memo" name="memo" placeholder="Memo" value="{{ old('memo') }}">
                @include('shared.error-field', ['fieldName' => 'memo'])
            </div>
            
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="exclude_from_budget" name="exclude_from_budget" value="Yes"
                        @if(old('exclude_from_budget'))
                            checked
                        @endif
                    > Exclude from Budget?
                </label>
                @include('shared.error-field', ['fieldName' => 'exclude_from_budget'])
            </div>    
            
        
            <div class="text-right">
                <input type="submit" class="btn btn-primary" />
            </div>
        </form>
    </div>
</div>
