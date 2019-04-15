@php
    use \Services\Table\Filter;
@endphp

<div class="row">
    <div class="col-md-12">

        <div class="float-left mr-1">
            <div class="btn-toolbar action-toolbar mb-3 d-none" role="toolbar">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    {{-- destroy button --}}
                    @if (in_array(Filter::DESTROY, $toolbar))
                        <button id="destroy-button" data-toggle="tooltip" data-placement="top" title="{{ __('table.action.destroy.tooltips') }}" class="btn btn-danger mb-2" type="button">
                            <i class="fa fa-times"></i>
                        </button>
                    @endif
                    {{-- trash button --}}
                    @if (in_array(Filter::TRASH, $toolbar))
                        <button id="trash-button" data-toggle="tooltip" data-placement="top" title="{{ __('table.action.delete.tooltips') }}" class="btn btn-dark mb-2" type="button">
                            <i class="fa fa-trash"></i>
                        </button>
                    @endif
                    {{-- publish button --}}
                    @if (in_array(Filter::PUBLISH, $toolbar))
                        <button id="publish-button" data-toggle="tooltip" data-placement="top" title="{{ __('table.action.publish.tooltips') }}" class="btn btn-dark mb-2" type="button">
                            <i class="fa fa-file-alt"></i>
                        </button>
                    @endif
                    {{-- draft button --}}
                    @if (in_array(Filter::DRAFT, $toolbar))
                        <button id="draft-button" data-toggle="tooltip" data-placement="top" title="{{ __('table.action.draft.tooltips') }}" class="btn btn-dark mb-2" type="button">
                            <i class="fa fa-file"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>

        {{-- sorting filter --}}
        @if (in_array(Filter::SORT, $toolbar))
            <div class="float-left">
                <select name="sort" data-toggle="tooltip" data-placement="top" title="{{ __('table.action.sort.tooltips') }}" class="selectpicker mb-2" id="sorting-table">
                    <option {{ request('sort') == 'asc' ? 'selected' : '' }} data-icon="fa fa-long-arrow-alt-down" value="asc">ASC</option>
                    <option {{ request('sort') == 'desc' || ! request()->has('sort') ? 'selected' : '' }} data-icon="fa fa-long-arrow-alt-up" value="desc">DESC</option>
                </select>
            </div>
        @endif

        {{-- searching --}}
        @if (in_array(Filter::SEARCH, $toolbar))
            <div class="float-right">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="q" id="text-search" value="{{ request()->has('q') ? request('q') : ''  }}" placeholder="{{ __('table.action.searching.placeholder') }}">
                    <div class="input-group-append">
                        <button id="btn-search" class="btn btn-secondary" type="button"  data-toggle="tooltip" data-placement="top" title="{{ __('table.action.searching.tooltips') }}"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- css --}}
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap-select.min.css') }}">
@endpush

{{-- js --}}
@push('js')
    <script src="{{ asset('admin/js/bootstrap-select.min.js') }}"></script>
    <script>
        $('#destroy-button').on('click', function() {
            if (confirm("{{ __('messages.destroy.confirmation') }}")) {
                var id = function () {
                    var ids = [];
                    $('.multi-checkbox:checked').each(function(i){
                        ids[i] = $(this).val();
                    });
                    return ids;
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{ route('admin.'.$name.'.batch.destroy') }}',
                    method:'POST',
                    data:{id:id()},
                    success:function() {
                        location.reload();
                    }
                });
            }
        });

        $('#sorting-table').on('change', function() {
            change_url('sort', $(this).val());
        })

        $('#btn-search').on('click', function() {
            let search_param = $('#text-search').val();
            change_url('q', search_param);
        })

        $('#text-search').on('keypress', function(e) {
            if (e.which == 13) {
                let search_param = $('#text-search').val();
                change_url('q', search_param);
            }
        })
    </script>
@endpush