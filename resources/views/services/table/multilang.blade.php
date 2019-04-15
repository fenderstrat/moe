@php
    $totalAvailableLocale = \Translation::getTotalSupportedLocale();
@endphp
@include('services.table.__filter_top')
<table class="table table-bordered table-striped table-sm" width="100%" cellspacing="0">
    <thead>
        <tr>
            <td rowspan="2" style="vertical-align: middle; text-align: center">
                <div class="form-check">
                    <input id="select-all" style="position:relative;" class="form-check-input multi-checkbox" type="checkbox">
                </div>
            </td>
            @foreach($rows as $row)
                <th rowspan="2">{{ __($name.'::table.head.'.$row) }}</th>
            @endforeach
            <th class="text-center" colspan="{{ $totalAvailableLocale * 2 }}">{{ __('table.head.locale') }}</th>
        </tr>
        <tr>
            @foreach (\Translation::getSupportedLocales() as $localeId=>$locale)
                <th colspan="2" class="text-center">{{ $localeId }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        {{-- hitung jumlah item, jika kosong tampilkan pesan --}}
        @if ($model->total() == 0)
            <tr>
                <td colspan="8" class="text-center">
                    {{-- jika data berupa hasil pencarian --}}
                    @if (request()->has('q'))
                        {{ __('table.action.searching.no_record') }}
                    @else
                        {{ __('table.no_record') }}
                    @endif
                </td>
            </tr>
        {{-- jika terdapat data, tampilkan data beserta action-nya --}}
        @else
            @foreach ($model as $item)
                <tr id="data-{{ $item->id }}">
                    <td style="text-align: center">
                        <div class="form-check">
                            <input style="position:relative;" name="id[]" class="form-check-input multi-checkbox checkbox-data" value="{{ $item->id }}" type="checkbox">
                        </div>
                    </td>
                    @foreach($rows as $row)
                        @if (str_contains($row, 'image'))
                            <td><img src="{{ $item->{$row} }}" alt="{{ $item->{$row} }}"></td>
                        @else
                            <td>{{ $item->{$row} }}</td>
                        @endif
                    @endforeach
                    @php
                        $locales = $item->translations->pluck('language')->all();
                    @endphp
                    @foreach (\Translation::getSupportedLocales() as $localeId=>$locale)
                        @if (in_array($localeId, $locales))
                            <td class="text-center">
                                <a title="{{ __('table.button.edit') }}" class="text-secondary" href="{{ route('admin.'.$name.'.edit', ['id'=>$item->id, 'locale' => $localeId]) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a onclick="confirm('{{ __('messages.destroy.confirmation') }}')" title="{{ __('table.button.destroy') }}" class="text-secondary" href="{{ route('admin.'.$name.'.destroy', ['id'=>$item->id, 'locale' => $localeId]) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        @else
                            <td colspan="2" class="text-center">
                                <a title="{{ __('table.button.add') }}" class="text-secondary" href="{{ route('admin.'.$name.'.add', ['id'=>$item->id, 'locale' => $localeId]) }}">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
@include('services.table.__filter_bottom')

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
