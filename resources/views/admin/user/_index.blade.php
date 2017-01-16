@if($users->isEmpty())
    <div class="list-group-item">Aucun·e utilisateur·rice</div>
@endif
<a href="{{ route('user.create') }}" class="list-group-item list-group-item-info">
    <i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i>
    Nouvel·le utilisateur·rice
</a>
@foreach($users as $user)
    <a href="{{ route('user.show', [$user] ) }}" class="list-group-item list-group-item-action justify-content-between">
        {{ $user->name }}
        <span>
            <span class="badge badge-default">
                {{ $user->role->type }}
            </span>
            <span class="badge badge-default">
                {{ $user->role->scope }}
            </span>
        </span>
    </a>
@endforeach