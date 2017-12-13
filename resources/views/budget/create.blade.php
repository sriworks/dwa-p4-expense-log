<form method="POST">
    {{ csrf_field() }}
    <h5 class="text-muted">New Budget Category</h5>
    <div class="form-group">
        <label for="category">Budget Category<span class="text-danger">*</span></label>
        <?php $selected_category = old('category', ''); ?>
        <select class="form-control" id="category" name="category" >
            @foreach ($categories as $category)
                <option value="{{$category->id}}" @if($selected_category == $category->id) {{'selected'}} @endif >
                    {{$category->term}}
                </option>
            @endforeach
        </select>
        @include('shared.error-field', ['fieldName' => 'category'])
    </div>
    <div class="form-group">
        <label for="monthly_budgeted_amount">Monthly Budget Amount</label>
        <div class="input-group">
            <span class="input-group-addon">$</span>
            <input type="number" class="form-control" id="monthly_budgeted_amount" name="monthly_budgeted_amount" placeholder="Monthly Budget Amount">
        </div>
        @include('shared.error-field', ['fieldName' => 'monthly_budgeted_amount'])
    </div>
    <div class="text-right">
        <input type="submit" class="btn btn-primary" />
    </div>
</form>