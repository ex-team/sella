<li class="{{ Request::is('pegawais*') ? 'active' : '' }}">
    <a href="{!! route('pegawais.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="home" data-size="18"
               data-loop="true"></i>
               Pegawai
    </a>
</li>

<li class="{{ Request::is('perangkats*') ? 'active' : '' }}">
    <a href="{!! route('perangkats.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="home" data-size="18"
               data-loop="true"></i>
               Perangkat
    </a>
</li>

<li class="{{ Request::is('peminjaman*') ? 'active' : '' }}">
    <a href="{!! route('peminjaman.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="home" data-size="18"
               data-loop="true"></i>
               Peminjaman
    </a>
</li>

