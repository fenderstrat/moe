@php
    $totalAvailableLocale = \Translation::getTotalSupportedLocale();
@endphp

<thead>
    <tr>
        <td rowspan="2" style="vertical-align: middle; text-align: center">
            <div class="form-check">
                <input id="select-all" style="position:relative;" class="form-check-input multi-checkbox" type="checkbox">
            </div>
        </td>
        <td rowspan="2"></td>
        @foreach($rows as $row)
            <th rowspan="2">{{ __($name.'::table.head.'.$row) }}</th>
        @endforeach
        @if (\Translation::isEnabled())
            <th class="text-center" colspan="{{ $totalAvailableLocale * 2 }}">{{ __('table.head.locale') }}</th>
        @endif
    </tr>
    <tr>
        @if (\Translation::isEnabled())
            @foreach (\Translation::getSupportedLocales() as $localeId=>$locale)
                <th colspan="2" class="text-center">{{ $localeId }}</th>
            @endforeach
        @else
            <th colspan="2" rowspan="2" style="text-align: center;">{{ __('table.head.action') }}</th>
        @endif
    </tr>
</thead>

@push('js')
    <script>
        $('#select-all').click(function(e){
            var table= $(e.target).closest('table');
            $('td input:checkbox',table).prop('checked',this.checked);
        });

        if ($('.multi-checkbox').is(':checked')) {
            $(".action-toolbar").removeClass('d-none');
        } else {
            $(".action-toolbar").addClass('d-none');
        }

        $('.multi-checkbox').on('click', function(e){
            if (this.checked == true){
                $(".action-toolbar").removeClass('d-none');
            } else {
                $(".action-toolbar").addClass('d-none');
            }
        });
    </script>
@endpush