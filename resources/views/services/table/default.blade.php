@include('services.table.__filter_top')
<table class="table table-bordered table-striped table-sm" width="100%" cellspacing="0">
    <thead>
        <tr>
            <td>
                <div class="form-check">
                    <input id="my-input" class="form-check-input" type="checkbox">
                </div>
            </td>
            @foreach($rows as $row)
                <th>{{ __($name.'::table.head.'.$row) }}</th>
            @endforeach
            <th colspan="2" style="text-align: center;">{{ __('table.head.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($model as $item)
            <tr id="data-{{ $item->id }}">
                <td>
                    <div class="form-check">
                        <input id="my-input" class="form-check-input" type="checkbox">
                    </div>
                </td>
                @foreach($rows as $row)
                    @if (str_contains($row, 'image'))
                        <td><img src="{{ $item->{$row} }}" alt="{{ $item->{$row} }}"></td>
                    @else
                        <td>{{ $item->{$row} }}</td>
                    @endif
                @endforeach
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
            </tr>
        @endforeach
    </tbody>
</table>
@include('services.table.__filter_bottom')
