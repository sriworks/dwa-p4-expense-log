<div class="modal fade" id="budgetDeleteConfirmModal" tabindex="-1" role="dialog" aria-hidden="true">
  <form id="budget-delete-form" method='POST' >
      {{ method_field('delete') }}
      {{ csrf_field() }}
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirm Budget Deletion!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure to delete the budget for <span id="budget_delete_confirm_category" class="font-weight-bold font-italic"></span>?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Confirm Delete!</button>
          </div>
        </div>
      </div>
  </form>
</div>