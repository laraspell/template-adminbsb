
<div class="menu">
  <ul class="list">
    <li class="header">MAIN NAVIGATION</li>
    @foreach(config('{? config_key ?}.menu') as $menu)
    <li class="{{ Request::route()->getName() == $menu['route']? 'active' : '' }}">
      <a href="{{ route($menu['route']) }}">
        <i class="material-icons">{{ $menu['icon'] }}</i>
        <span>{{ $menu['label'] }}</span>
      </a>
    </li>
    @endforeach
  </ul>
</div>