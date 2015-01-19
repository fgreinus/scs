<table class="table table-striped">
@forelse ($logEntries as $log)
    <tr>
        <th>
            @if($log->entry->trashed())
            <i class="small glyphicon glyphicon-{{ $log->action->icon }} }}"></i> {{ Str::limit($log->entry->title, 25) }}
            @else
            <a href="{{ URL::route('entry_detail', $log->entry->id) }}"><i class="small glyphicon glyphicon-{{ $log->action->icon }} }}"></i> {{ Str::limit($log->entry->title, 25) }}</a>
            @endif
        </th>
        <th class="small text-right">
            {{ HTML::time_elapsed($log->created_at) }} ago by {{ HTML::username($log->user_id) }}
        </th>
    </tr>
    <tr>
        <td class="small" colspan="2">
            {{ wordwrap($log->note, 40, "<br>", true) }}
            <div class="pull-right text-right">
                {{ HTML::actionLabel($log->action_id) }}
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td>No changes found here.</td>
    </tr>
@endforelse
</table>