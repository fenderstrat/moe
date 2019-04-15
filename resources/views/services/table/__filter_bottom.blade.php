<div class="float-left">
    <select name="per_page" data-toggle="tooltip" data-placement="top" title="{{ __('table.action.per_page.tooltips') }}" class="selectpicker mb-2" id="paging-table">
        <option {{ request('per_page') == '10' || ! request()->has('per_page') ? 'selected' : '' }} value="10">10</option>
        <option {{ request('per_page') == '15' ? 'selected' : '' }} value="15">15</option>
        <option {{ request('per_page') == '20' ? 'selected' : '' }} value="20">20</option>
        <option {{ request('per_page') == '25' ? 'selected' : '' }} value="25">25</option>
    </select>
</div>
<div class="float-right">
    {{ $model->appends(request()->query())->links() }}
</div>

@push('js')
    <script>
        $('#paging-table').on('change', function() {
            change_url('per_page', $(this).val())
        })
    </script>
@endpush