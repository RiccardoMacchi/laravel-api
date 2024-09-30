<aside class="text-bg-dark">
    <ul>
        <li><a href="{{ route('admin.home') }}"><i class="fa-solid fa-house"></i><span class="d-none d-md-inline">
                    Home</span></a>
        </li>
        <li><a href="{{ route('admin.items.index') }}"><i class="fa-solid fa-list"></i><span class="d-none d-md-inline">
                    Elenco Lavori</span></a></li>
        <li><a href="{{ route('admin.items.create') }}"><i class="fa-solid fa-newspaper"></i><span
                    class="d-none d-md-inline"> Aggiungi Lavoro</span></a></li>
        <li><a href="{{ route('admin.itemsTypes') }}"><i class="fa-regular fa-folder-open"></i><span
                    class="d-none d-md-inline"> Lavori per Tipo</span></a>
        </li>
        <li><a href="{{ route('admin.types.index') }}"><i class="fa-solid fa-layer-group"></i><span
                    class="d-none d-md-inline"> Gestisci Tipi</span></a></li>
        <li><a href="{{ route('admin.techs.index') }}"><i class="fa-solid fa-microchip"></i><span
                    class="d-none d-md-inline"> Gestiscle Tecnologie</span></a>
        </li>
    </ul>
</aside>
