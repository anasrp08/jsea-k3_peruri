@if (Auth::check())
@role(['admin','operator'])
<li class="nav-item">
    <a href="{{ url('/') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('evaluasi.list') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Daftar Tender</p>
    </a>
</li>
@endrole
 
{{-- <li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            Pengangkutan
            <i class="fas fa-angle-left right"></i> 
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('pemohon.entri') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Buat Permohonan</p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('pemohon.listview') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Permohonan</p> 
            </a>
        </li>

    </ul>
</li> --}}

    <li class="nav-item">
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
          {{-- <i class="fa fa-sign-out"></i> --}}
          <i class="nav-icon fas fa-tree"></i>
          {{-- <i class="far fa-circle nav-icon"></i> --}}
          <p>Logout</p>
      </a>
  
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>
  </li>
  @endif
  
