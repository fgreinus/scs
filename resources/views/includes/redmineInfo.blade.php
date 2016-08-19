@if($ticketInfo)
<div class="panel panel-default">
    <div class="panel-heading">Ticket Information (ID: {{ $ticketInfo["id"] }})<a href="{{ Config::get('redmine.url') }}/issues/{{ $ticketInfo["id"] }}" class="btn btn-info pull-right btn-xs">zum Ticket</a></div>
    <div class="panel-body">
        <table class="table table-striped small">
            <tr>
                <td><strong>Subject:</strong></td>
                <td>{{ $ticketInfo["subject"] }}</td>
            </tr>
            <tr>
                <td><strong>Creator:</strong></td>
                <td>{{ $ticketInfo["author"]["name"] }}</td>
            </tr>
            <tr>
                <td><strong>Status:</strong></td>
                <td>{{ $ticketInfo["status"]["name"] }}</td>
            </tr>
            <tr>
                <td><strong>Priority:</strong></td>
                <td>{{ $ticketInfo["priority"]["name"] }}</td>
            </tr>
            <tr>
                <td><strong>Last Update:</strong></td>
                <td>{{ HTML::time_elapsed($ticketInfo["updated_on_date"]) }} before</td>
            </tr>
            <tr>
                <td><strong>Created:</strong></td>
                <td>{{ HTML::time_elapsed($ticketInfo["created_on_date"]) }} before</td>
            </tr>
        </table>
    </div>
</div>
@endif