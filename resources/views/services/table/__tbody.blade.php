@php
    use App\Constants\Status;
@endphp
<tbody>
    @forelse ($model as $item)
        @php
            $locales = $item->translations->pluck('language')->all();
        @endphp

        <tr id="data-{{ $item->id }}">
            {{-- checkbox --}}
            <td style="text-align: center">
                <div class="form-check">
                    <input style="position:relative;" name="id[]" class="form-check-input multi-checkbox checkbox-data" value="{{ $item->id }}" type="checkbox">
                </div>
            </td>

            {{-- status --}}
            <td class="text-center">
                @if (isset($item->status))
                    @switch($item->status)
                        @case(Status::TRASH)
                            <span data-toggle="tooltip" data-placement="top" title="{{ __('table.status.trash.tooltips') }}" class="dot bg-danger"></span>
                            @break
                        @case(Status::DRAFT)
                            <span data-toggle="tooltip" data-placement="top" title="{{ __('table.status.draft.tooltips') }}" class="dot bg-warning"></span>
                            @break
                        @case(Status::PUBLISH)
                            <span data-toggle="tooltip" data-placement="top" title="{{ __('table.status.publish.tooltips') }}" class="dot bg-success"></span>
                            @break
                    @endswitch
                @else
                    <span data-toggle="tooltip" data-placement="top" title="{{ __('table.status.publish.tooltips') }}" class="dot bg-success"></span>
                @endif
            </td>

            {{-- loop data berdasarkan item yang ingin ditampilkan --}}
            @foreach($rows as $row)
                @if (str_contains($row, 'image'))
                    <td><img src="{{ $item->{$row} }}" alt="{{ $item->{$row} }}"></td>
                @else
                    <td>{{ $item->{$row} }}</td>
                @endif
            @endforeach

            {{-- link aksi --}}
            @if (\Translation::isEnabled())
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
            @else
                <td style="text-align: center;">
                    <a title="{{ __('table.button.edit') }}" class="text-secondary" href="{{ route('admin.'.$name.'.edit', ['id'=>$item->id]) }}">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </td>
                <td style="text-align: center;">
                    <a onclick="confirm('{{ __('messages.destroy.confirmation') }}')" title="{{ __('table.button.destroy') }}" class="text-secondary" href="{{ route('admin.'.$name.'.destroy', ['id'=>$item->id]) }}">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            @endif
        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-center">
                <?= (request()->has('q')) ? __('table.action.searching.no_record') :  __('table.no_record'); ?>
            </td>
        </tr>
    @endforelse
</tbody>