@if($virtual_numbers->isEmpty())
    <div class="list-group-item">Aucun numéro virtuel</div>
@endif
<a href="{{ route('virtual_number.create') }}" class="list-group-item list-group-item-info">
    <i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i>
    Nouveau numéro virtuel
</a>
@foreach($virtual_numbers as $virtual_number)
    <a href="{{ route('virtual_number.show', [$virtual_number] ) }}" class="list-group-item list-group-item-action justify-content-between">
        {{ $virtual_number->number }} ({{ $virtual_number->name }})
        <span class="pull-right badge badge-default">
            Assigné à {{ $virtual_number->sections->count() }} section(s)
        </span>
    </a>
@endforeach