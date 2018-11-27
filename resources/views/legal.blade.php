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
        <div class="nadpis1" id="legal-nadpis"><h1>OCHRANA OSOBNÍCH ÚDAJŮ</h1></div>
        <div id="legal-text">
            <p>
                Stisknutím tlačítka "Objednat", souhlasíte s tím, že vás můžeme telefonicky a emailem kontaktovat za účelem řešení ochrany pojistných rizik Vás a Vaší rodiny.<br><br>
                Zároveň se můžete těšit na zajímavé informace z oboru financí,
                které Vám budeme zpravidla 1x měsíčně posílat emailem. Pokud už nebudete chtít email newslettery dále dostávat,
                tak se kdykoli můžete odhlásit a tento souhlas odvolat prostřednictvím odhlašovacího odkazu v každé zprávě.
                Vaše údaje budeme spravovat pod firmou Boneo ekonomické poradenství s.r.o. a řídit se těmito zásadami zpracování a ochrany osobních údajů.
                <br>
                <br>
                <span><b>ZPRACOVÁNÍ A OCHRANA OSOBNÍCH ÚDAJŮ</b></span><br>
                Pokud jste naším zákazníkem, odběratelem novinek nebo návštěvníkem webu, svěřujete nám své osobní údaje. My zodpovídáme za jejich ochranu a zabezpečení.
                Seznamte se, prosím, s ochranou osobních údajů, zásadami a právy, které máte v souvislosti s GDPR (Nařízení o ochraně osobních údajů).
                <br><br>
                Jsme společnost Boneo ekonomické poradenství s.r.o., IČ 24236861, se sídlem Durchova 101/66, 142 00 Praha zapsaná u Městského soudu v Praze pod spisovou značkou 201200 C,
                která provozuje webové stránky skakejvpoho.cz, boneo.cz. Vaše osobní údaje zpracováváme jako správce, tj. určujeme, jak budou osobní údaje zpracovávány a za jakým účelem,
                po jak dlouhou dobu a vybíráme případné další zpracovatele, kteří nám se zpracováním budou pomáhat.
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
