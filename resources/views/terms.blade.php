@extends('layouts.web')

@section('content')

    <div id="menu">
        <div id="left">

            <ul id="nav-take">
                <li class=""><a href="/"> O NÁS </a></li>
                <li class=""><a href="/"> VÝBĚR KROUŽKŮ </a></li>
                <li class=""><a href="/"> KONTAKT </a></li>
            </ul>
        </div>
        <div id="middle">
            <div id="logo_menu"> <img src="{{ asset('images/logo.png') }}" alt="logo" draggable="false"> </div>
        </div>
        <div id="right">
            <div id="fb_logo"> <a href="https://www.facebook.com/Urban-Sense-Academy-1621345168099222/"> <img src="{{ asset('images/FB-IC.svg') }}" alt="logo" draggable="false"> </a></div>
            <div id="ig_logo"> <a href="https://www.instagram.com/urbansenseacademy/"><img src="{{ asset('images/IG-IC.svg') }}" alt="logo" draggable="false"></a> </div>
        </div>
    </div>

    <div id="legal-page">
        <div id="cara4"></div>
        <div class="nadpis1" id="legal-nadpis"><h1>Podmínky Urban Sense Academy</h1></div>
        <div id="legal-text">
            <p>
                Každý cvičenec parkour kroužku v Urban Sense Academy mladší 18-ti let podléhá řádu Urban Sense Academy a naslouchá pokynům trenérů. Nedodržení řádu může být v krajním případě potrestáno i vyloučením. Pokud cvičenec takto opustí Urban Sense Academy, ztratí nárok na vrácení poplatku. Pokud cvičenec nenastoupí do parkour kroužku, ztratí nárok na vrácení poplatku. Za svou bezpečnost, osobní věci a cennosti si během celé účasti na parkour kroužku každý cvičenec zodpovídá sám, nebo za jeho bezpečnost odpovídají zákonní zástupci. Účastník se zříká jakékoliv náhrady za zranění, ublížení na zdraví či poškození věci. Doporučujeme zajistit si úrazové pojištění vhodné pro aktivity se zvýšeným rizikem úrazu.
                Potvrzuji pravdivost uvedených osobních údajů a jsem seznámen a plně souhlasím
                s tímto prohlášením a to stvrzuji svým přihlášením do Urban Sense Academy.
            </p>
        </div>
    </div>


    <div id="footer" style="display:block; top:0;">
        <div id="footer-text">
            <div id="copyright">
                <p>Copyright © Urbansenseacademy 2018</p>
            </div>
            <div id="udaje">
                <p><a href="{{ route('legal') }}" class="no-decor" style="color:#666666">zpracování a ochrana osobních údajů</a></p>
            </div>
            <div id="author">
                <p>Webdesign by <a href="http://www.tomeno.cz" class="no-decor"><img src="{{ asset('images/tomeno.png') }}"></a> </p>
            </div>
        </div>
    </div>

@endsection
