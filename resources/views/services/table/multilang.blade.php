@php
    $totalAvailableLocale = \Translation::getTotalSupportedLocale();
@endphp
<table class="table table-bordered table-striped table-sm" width="100%" cellspacing="0">
        <thead>
            <tr>
                @foreach($rows as $row)
                    <th rowspan="2">{{ __($name.'::table.head.'.$row) }}</th>
                @endforeach
                <th style="text-align:center;" colspan="{{ $totalAvailableLocale * 2 }}">{{ __('table.head.locale') }}</th>
            </tr>
            <tr>
                @foreach (\Translation::getSupportedLocales() as $localeId=>$locale)
                    <th colspan="2" style="text-align:center;">{{ $localeId }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($model as $item)
                <tr>
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
                            <td style="text-align:center;">
                                <a title="{{ __('table.button.edit') }}" class="text-secondary" href="{{ route('admin.'.$name.'.edit', ['id'=>$item->id, 'locale' => $localeId]) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </td>
                            <td style="text-align:center;">
                                <a onclick="confirm('{{ __('messages.destroy.confirmation') }}')" title="{{ __('table.button.destroy') }}" class="text-secondary" href="{{ route('admin.'.$name.'.destroy', ['id'=>$item->id, 'locale' => $localeId]) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        @else
                            <td colspan="2" style="text-align:center;">
                                <a title="{{ __('table.button.add') }}" class="text-secondary" href="{{ route('admin.'.$name.'.add', ['id'=>$item->id, 'locale' => $localeId]) }}">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="float-right">
        {{ $model->links() }}
    </div>
