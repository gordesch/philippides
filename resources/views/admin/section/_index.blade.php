@if($sections->isEmpty())
    <div class="list-group-item">Aucune section</div>
@endif
<a href="{{ route('section.create') }}" class="list-group-item list-group-item-info">
    <i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i>
    Nouvelle section
</a>
@foreach($sections as $section)
    <a href="{{ route('section.show', [$section] ) }}" class="list-group-item list-group-item-action justify-content-between">
        {{ $section->name }}
        <span class="pull-right badge badge-default">
            {{ $section->users()->count() }} utilisateur·rice·s
        </span>
    </a>
@endforeach