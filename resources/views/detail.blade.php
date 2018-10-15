@extends('layouts.web')

@section('content')
    <div id="menu" style="display: block; opacity: 1;">
        <div id="left">

            <ul id="nav-take">
               <li class=""><a href="/#page2"> O NÁS </a></li>
                <li class=""><a href="/#page3"> VÝBĚR KROUŽKŮ </a></li>
                <li class=""><a href="/#page4"> KONTAKT </a></li>

            </ul>
        </div>
        <div id="middle">
            <div id="logo_menu"> <a href="/"><img src="{{ asset('images/logo.png') }}" alt="logo" draggable="false"></a></div>
        </div>
        <div id="right">
            <div id="fb_logo"><a href="https://www.facebook.com/Urban-Sense-Academy-1621345168099222/"> <img
                        src="{{ asset('images/FB-IC.svg') }}" alt="logo" draggable="false"> </a></div>
            <div id="ig_logo"><a href="https://www.instagram.com/urbansenseacademy/"><img
                        src="{{ asset('images/IG-IC.svg') }}" alt="logo" draggable="false"></a></div>
        </div>
    </div>
    <div id="detail-page">
        <div id="cara4"></div>
        <div class="detail-nadpis nadpis1">
            <h1>
                @if ($training->type == 1)
                    WORKSHOP
                @else
                    PARKOUR KROUŽEK
                @endif
                {{ $city->name }}</h1>
            <br>
            <div class="cena nadpis1">
                <h1>{{ $training->price }} Kč</h1>
            </div>
        </div>
        <div id="info-detail">

            @if ($training->type == 1)
                <div class="blok">
                    <div class="blok-text" id="cas">
                        <p><b>DATUM</b><br><span>{{ $training->date()->format('j.n. Y') }}</span></p>
                    </div>
                </div>

                <div class="blok">
                    <div class="blok-text" id="den">
                        <p><b>ČAS</b><br><span>{{ $training->time }}</span></p>
                    </div>
                </div>
                <div class="blok" id="info_blok">
                    <div class="blok-text" id="info">
                        <p>
                            <b>DOPLŇUJÍCÍ INFORMACE</b><br>
                            Věk: od 8 let, případně podle šikovnosti <br>
                            Náročnost pro začátečníky i pokročilé <br>
                            Jednodenní intenzivní parkour akce
                        </p>
                    </div>
                </div>

            @else
                <div class="blok">
                    <div class="blok-text" id="cas">
                        <p><b>ČAS</b><br><span>{{ $training->time }}</span></p>
                    </div>
                </div>
                <div class="blok">
                    <div class="blok-text" id="den">
                        <p><b>DEN KROUŽKU</b><br><span>{{ $training->day }}</span></p>
                    </div>
                </div>
                <div class="blok" id="info_blok">
                    <div class="blok-text" id="info">
                        <p>
                            <b>DOPLŇUJÍCÍ INFORMACE</b><br>
                            Září 2018 - Leden 2019 <br>
                            Věk: od 8 let, případně podle šikovnosti <br>
                            Náročnost pro začátečníky i pokročilé <br>
                            Tréninky 1x týdně (60 minut)
                        </p>
                    </div>
                </div>

                <div class="blok">
                    <div class="blok-text" id="trener">
                        <p><b>TRENÉR</b><br><span>{{ $training->trainer }}</span></p>
                    </div>
                </div>
            @endif

            <div class="blok">
                <div class="blok-text" id="mesto">
                    <p>
                        <b>ADRESA</b>
                        <br>
                        <span>{{ $training->address }}</span>
                        <br>
                    </p>
                </div>
            </div>
            <div class="blok">
                <div class="blok-text" id="mista">
                    <p><b>VOLNÁ MÍSTA</b><br><span>{{ $training->free_count() }} VOLNÝCH MÍST</span></p>
                </div>
            </div>

            {{--<div class="blok">--}}
                {{--<div class="blok-text">--}}
                    {{--<p><b>OBDOBÍ</b><br><span>{{ $training->season }}</span></p>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>

        @if ($training->type == 1)
        @else
            @if ($training->free_count())
                <a href="/form/{{$training->id}}" class="button_prihlasit" id="detail-button">PŘIHLÁSIT SE NA KROUŽEK</a>
            @else
                <a href="/form/{{$training->id}}" class="button_prihlasit" id="detail-button">PŘIHLÁSIT NÁHRADNÍKA NA KROUŽEK</a>
            @endif
        @endif

        {{--@include('forms.form')--}}

    </div>
    <div id="mapa_detail">
        <{{--iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118468.3835912162!2d14.444662333816865!3d48.99524599773408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47734fb43a5f629b%3A0x400af0f6614de80!2zxIxlc2vDqSBCdWTEm2pvdmljZQ!5e0!3m2!1scs!2scz!4v1533296011968"
            frameborder="0" style="border:0" allowfullscreen
        ></iframe>--}}
        <iframe
            src="https://maps.google.com/maps?q={{$city->name}},{{$training->address}}&t=&z=13&ie=UTF8&iwloc=&output=embed"
            frameborder="0" style="border:0" allowfullscreen
        ></iframe>
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
                <p>Webdesign by <a href="http://www.tomeno.cz" class="no-decor"><img
                            src="{{ asset('images/tomeno.png') }}"></a></p>
            </div>
        </div>
    </div>
@endsection
