// Budget Related Listeners

var budgetModule = (function() {
    "use strict"
    
    var _init = function(){
        // Add Budget Delete Model Listener. Dynamically change budget DELETE URls.
        $('#budgetDeleteConfirmModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var category = button.data('category');
            var budgetId = button.data('budgetid');
            var modal = $(this);
            modal.find('#budget_delete_confirm_category').text(category);
            modal.find('#budget-delete-form').attr('action', '/budget/' + budgetId);
            
        });
    }
    
    return {
        init: _init
    }
})();


var expenseModule = (function() {
    "use strict"
    
    var _init = function(){
        $("#expense_tag_select").select2();
        
        // Add Expense Delete confirm Modal.
        $('#expenseDeleteConfirmModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var transactiondate = button.data('transactiondate');
            var amount = button.data('amount');
            var expenseId = button.data('expenseid');
            var modal = $(this);
            modal.find('#expense_delete_confirm_transactiondate').text(transactiondate);
            modal.find('#expense_delete_confirm_amount').text(amount);
            modal.find('#budget-delete-form').attr('action', '/expense/' + expenseId);
            
        });        
    }
    
    return {
        init: _init
    }
})();

$("document").ready(function () {
    budgetModule.init();
    expenseModule.init();
});
