@extends('layouts.web')

@section('content')

    <div id="menu" style="display: block; opacity: 1;">
        <div id="left">

            <ul id="nav-take">
                <li class=""><a href="/#page2"> O NÁS </a></li>
                <li class=""><a href="/#page3"> VÝBĚR MĚST </a></li>
                <li class=""><a href="/#page4"> KONTAKT </a></li>
            </ul>
        </div>
        <div id="middle">
            <div id="logo_menu"> <a href="/"><img src="{{ asset('images/logo.png') }}" alt="logo" draggable="false"></a> </div>
        </div>
        <div id="right">
            <div id="fb_logo"> <a href="https://www.facebook.com/Urban-Sense-Academy-1621345168099222/"> <img src="{{ asset('images/FB-IC.svg') }}" alt="logo" draggable="false"> </a></div>
            <div id="ig_logo"> <a href="https://www.instagram.com/urbansenseacademy/"><img src="{{ asset('images/IG-IC.svg') }}" alt="logo" draggable="false"></a> </div>
        </div>
    </div>

    <div id="legal-page">
        <div id="cara4"></div>
        <div class="nadpis1" id="legal-nadpis"><h1>Přihláška úspěšně odeslána.</h1></div>
        <div id="legal-text">
            <p>
				Právě jsme na Vámi uvedený email zaslali potvrzení o přihlášení do kroužku s bližšími informacemi a pokyny k platbě.
            </p>
        </div>
    </div>


    <div id="footer" style="display:block; top:0;">
        <div id="footer-text">
            <div id="copyright">
                <p>Copyright © Urbansenseacademy 2018</p>
            </div>
            <div id="udaje">
                      <p><a href="/legal" class="no-decor" style="color:#666666">zpracování a ochrana osobních údajů</a><br>
					  <a href="{{ route('terms') }}" class="no-decor" style="color:#666666">podmínky Urban Sense Academy</a>
                    </p>
            </div>
            <div id="author">
                <p>Webdesign by <a href="http://www.tomeno.cz" class="no-decor"><img src="{{ asset('images/tomeno.png') }}"></a> </p>
            </div>
        </div>
    </div>

@endsection
