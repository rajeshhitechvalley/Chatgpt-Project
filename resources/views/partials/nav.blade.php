
    @php
        $icons = [
            'Featured'    => '⚔️',
            'Action'      => '⚔️',
            'New'         => '🗺️',
            'Adventure'   => '🗺️',
            'Popular'     => '🧩',
            'Puzzle'      => '🧩',
            'Original'    => '🧩',
            'Updated'     => '🧩',
            'Sports'      => '⚽',
            'Racing'      => '🏎️',
            'Basketball'  => '🏀',
            'Strategy'    => '🎯',
            'Soccer'      => '⚾',
            'Escape'      => '🚪',
            'Controller'  => '🎮',
            'Bike'        => '🏍️',
            'Clicker'     => '👆',
            'Car'         => '🚗',
            'Driving'     => '🚗',
            'Card'        => '🃏',
            'Casual'      => '🎲',
            'Comet'       => '🗡️',
            'RPG'         => '🗡️',
            'Shooting'    => '🔫',
            'Fighting'    => '🥊',
            'Simulation'  => '✈️',
            'Multiplayer' => '👥',
        ];
    @endphp




<nav class="nav-section">
    {{-- Home --}}
    <a href="{{ url('/') }}" 
       class="nav-item {{ request()->is('/') ? 'active' : '' }}">
        <span class="nav-icon">🏠</span>
        <span>Home</span>
    </a>

    <div class="divider"></div>

    {{-- Categories --}}
   
    @foreach($categories as $category)
    
        <a href="{{ route('category.show', $category) }}"
           class="nav-item {{ request()->is('category/'.$category) ? 'active' : '' }}">
            <span class="nav-icon">{{ $icons[$category] ?? '🎮' }}</span>
            <span>{{ $category }}</span>
        </a>
    @endforeach
</nav>
