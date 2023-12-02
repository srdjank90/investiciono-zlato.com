<div>
    <table class="lp-table table">
        <thead>
            @foreach($columns as $key => $column)
            <th width="{{$column['width']}}">{{$column['label']}}</th>
            @endforeach
            <th width="120"></th>
        </thead>
        <tbody>
            @foreach($data as $key => $value)
            <tr>
                @foreach($columns as $key => $column)
                <td>
                    @if(isset($column['type']) && $column['type'] == "array")
                    @foreach($value[$column['attribute']] as $key => $item)
                    <span class="badge bg-info text-dark">{{ $item->name }}</span>
                    @endforeach
                    @else
                    {{$value[$column['attribute']]}}
                    @endif
                </td>
                @endforeach
                <td class="lp-table-actions">
                    @foreach($actions as $action)
                    <a href="{{$action['url']}}{{$value[$action['param']]}}" {{$action['model']}} {{$action['data-type']}}"{{ isset($action['data']) ? $value[$action['data']] : ''}}" class="btn btn-{{$action['class']}} btn-sm rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$action['title']}}">
                        <i class="{{$action['icon']}}"></i>
                    </a>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</div>
