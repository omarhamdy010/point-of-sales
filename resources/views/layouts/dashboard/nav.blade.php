<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="btn-group mb-1">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle me-1" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if ( Config::get('app.locale') == 'en')

                    {{ 'English' }}

                @elseif ( Config::get('app.locale') == 'ar' )

                    {{ 'العربيه' }}

                @endif        
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a rel="alternate" class="dropdown-item" hreflang="{{ $localeCode }}"
                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- @if(!auth()->user())
        <div class="btn-group mb-1">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle me-1" type="button" id="dropdownMenuButton"
                  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="{{ route('login') }}" rel="alternate" class="dropdown-item">Log in</a>
                </div>
            </div>
        </div>
        
        @endif -->
        <!-- <div class="dropdown" style="width:250px; float:right;">
            @auth
                <a class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <span
                        class="text-xs font-bold uppercase">{{ auth()->user()->first_name }}{{ auth()->user()->last_name }}</span>
                </a>
                <div class="dropdown-menu">
                    <form method="POST" action="/logout" class="">
                        @csrf

                        <button class="btn btn-light-secondary" style="background: #ffffff" type="submit">Log Out
                        </button>
                    </form>
                </div>
            @endauth
        </div> -->

    </div>
</nav>
