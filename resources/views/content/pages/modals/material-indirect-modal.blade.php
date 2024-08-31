<div class="modal fade" id="materilaindirectmodal" tabindex="-1" aria-labelledby="materilaindirectmodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBusinessUnitModalLabel">Material Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="salary-from">
                    <input type="hidden" id="businessUnitId" name="business_unit_id">
                    <div class="mb-3">
                        <label for="businessUnitSource" class="form-label">Type</label>
                        <select class="form-select" id="businessUnitSource" name='type'="source" required>
                            <option value="cost">Cost</option>
                            <option value="revenue">Revenue</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="businessUnitDetail" class="form-label">Contract</label>
                        <input type="text" class="form-control" id="Contract" name="contract">
                    </div>
                    <div class="mb-3">
                        <label for="businessUnitRemark" class="form-label">PO</label>
                        <input type="text" class="form-control" id="PO" name="po">
                    </div>
                    <div class="mb-3">
                        <label for="businessUnitRemark" class="form-label">Expenses</label>
                        <input type="text" class="form-control" id="Expenses" name="expenses">
                    </div>
                    <div class="mb-3">
                        <label for="businessUnitRemark" class="form-label">Description</label>
                        <input type="text" class="form-control" id="Description" name="description">
                    </div>
                    <div class="mb-3">
                        <label for="businessUnitStatus" class="form-label">Status</label>
                        <select class="form-select" id="businessUnitStatus" name="status">
                            <option value="new-hiring">New Hiring</option>
                            <option value="exisiting-resource">Existing Resource on sharing</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>