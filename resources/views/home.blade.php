@extends('layouts.web')

@section('content')

    <div id="upper">
        <div id="logo"><img src="{{ asset('images/logo.png') }}" alt="logo" draggable="false"></div>
        <section class="container">
            <h1>
                <span class="title">Academy</span>
            </h1>
        </section>
    </div>
	<div id="menu">
            <div id="left">
                <ul id="nav-take">
                    <li class=""><a href="#page2"> O NÁS </a></li>
                    <li class=""><a href="#page3"> VÝBĚR KROUŽKŮ </a></li>
                    <li class=""><a href="#page4"> KONTAKT </a></li>
                </ul>
            </div>
            <div id="middle">
                <div id="logo_menu_main"><a href="#main"><img src="{{ asset('images/logo.png') }}" alt="logo" draggable="false"></a></div>
            </div>
            <div id="right">
                <div id="fb_logo">
                    <a href="https://www.facebook.com/Urban-Sense-Academy-1621345168099222/" target="_blank"><img
                            src="{{ asset('images/FB-IC.svg') }}"
                            alt="facebook" draggable="false"></a>
                </div>
                <div id="ig_logo">
                    <a href="https://www.instagram.com/urbansenseacademy/" target="_blank"><img
                            src="{{ asset('images/IG-IC.svg') }}" alt="instagram"
                            draggable="false"></a>
                </div>
            </div>
    </div>
    <div id="main" data-ibg-bg="{{ asset('images/header.jpg') }}">

        <div id="nadpis">
			<h1>URBAN SENSE <br> ACADEMY</h1><br>
			<p>PARKOUR KROUŽKY</p>
		
		</div>
     
    </div>

    <div id="page2">
         <div id="scroll_down">		
			<div id="carka_move">
			</div>		 
			<a href="#page2"><img src="{{ asset('images/scroll.png') }}" alt="scroll" draggable="false"></a>
			
		</div>
        <div id="about-text">
            <div class="nadpis1">
                <h1>O ACADEMY</h1>
            </div>
            <div class="text1">
                <p>Parkour a freerun vyžadují kvalitní a bezpečné zázemí a vedení, které vytváříme v našich
                    akademiích zaštítěné mezinárodním parkour týmem Urban Sense. V Academy Vás naučíme
                    základům parkouru a dáme prostor pro Váš rychlý rozvoj v tréninku.
                </p>
            </div>
            <div class="vyhody-seznam">

                <p>BEZPEČNÉ ZÁZEMÍ</p>
                <p>PROFESIONÁLNÍ VEDENÍ</p>

                <p>PŘÁTELSKÝ KOLEKTIV</p>
                <p>ZNÁMÉ TVÁŘE</p>

            </div>
        </div>
        <a href="#page3" class="no-decor">
            <div id="krouzky-button" style="text-decoration: none;">
                <p>VÝBĚR KROUŽKŮ</p>
            </div>
        </a>
        <div id="cara2">

        </div>
    </div>

    <div id="page3">
        <div class="nadpis1" id="nadpis2">
            <h1>VÝBĚR KROUŽKŮ</h1>
        </div>
        <div id="mapa">  <!-- base mapa - podklad -->
            <img src="{{ asset('images/cr.png') }}" draggable="false" alt="republika">
            <div href="#tabulka" class="no-decor">
                @foreach($cities as $city)
                    <div class="point" onclick="tabulka('city_{{ $city->id  }}')" style="top: {{ $city->y }}%; left: {{ $city->x }}%">
                        <!-- bod na mape s mestem, poctem mist atd -->

                        <img src="{{ asset('images/pointer.png') }}" onclick="tabulka('city_{{ $city->id  }}')"
                            alt="pointer"
                            draggable="false">

                        <div class="number">
                            <!--volne mista-->
                            <p onclick="tabulka('city_{{ $city->id  }}')">{{ count($city->trainings) }}</p>
                        </div>

                        <a href="#tabulka" class="no-decor">
                            <div class="point-text">
                                <!-- nadpis mesta -->
                                <p><b>{{ $city->name }}</b></p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div id="mesta_mobil">
            @foreach($cities as $city)
                <div class="button_mesta" style="text-decoration: none;" onclick="tabulka('city_{{ $city->id  }}')">
                    <p>{{ $city->name }}</p>
                </div>
            @endforeach
        </div>
        <div id="tabulka" style="overflow-x:auto">
            @foreach($cities as $city)
                <table id="city_{{ $city->id }}">
                    <tr>
                        <th>Cena</th>
                        <th>Město</th>
                        <th>Již přihlášených</th>
                        <th>Den</th>
                        <th>Čas konání</th>
                        <th></th>
                    </tr>
                    @foreach ($city->trainings as $training)
                        <tr>
                            <td><b>{{ $training->price }} Kč</b></td>
                            <td><b>{{ $city->name  }}</b></td>
                            <td class="move"><b>{{ $training->paid_count() }}/{{ $training->capacity  }}</b></td>
                            <td>{{ $training->day  }}</td>
                            <td>{{ $training->time  }}</td>
                            <td>
                                <a href="#page3" class="no-decor">
                                    <a href="{{ route('detail', ['training' => $training->id]) }}"
                                        class="button_prihlasit" style="text-decoration: none;">
                                        <p>{{ __('DETAIL') }}</p>
                                    </a>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endforeach
        </div>
        <div id="cara3">

        </div>

        <div id="page4">

            <div id="kontakt-nadpis" class="nadpis1">
                <h1>KONTAKT</h1>
            </div>
            <div id="kontakt-text" class="no-decor">
                <p class="no-decor">Urban Sense
                    <br>
                    U Dvora 1059/4, 586 01 Jihlava<br>
			        IČ: 22754211<br><br>
					
				    <span><a class="no-decor" style="color: #C01414;" href="mailto:info@usacademy.cz"><b>info@usacademy.cz</b></a>
                    <br>
                    <a class="no-decor" style="color: #C01414;"
                        href="callto:+420 773 074 651"><b>+420 773 074 651</b></a>
                    </span>
                </p>
            </div>

        </div>

        <div id="footer">
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

    </div>



    <script>
        function _(id) {
            return document.getElementById(id);
        }

        var logo = _("logo");
        var upper = _("upper");
        var main = _("main");
        var menu = _("menu");
        var page2 = _("page2");
        var page3 = _("page3");
        var page4 = _("page4");
        var footer = _("footer");
        var vyska = 1;
		var opacity = 0;
        var timer_anim;
		menu.style.position = "fixed";
		 var timer_2;
        setTimeout(function () {
            logo.style.opacity = 1;
			timer_anim = setInterval(upper_slide, 1);
		   main.style.display = "block";
        }, 1000);
		 setTimeout(function () {
		timer_2 = setInterval(opacity_show, 1);
		clearInterval(timer_anim);
		upper.style.opacity = 0;
        }, 1500);
        setTimeout(function () {
			menu.style.display = "block";
            page2.style.display = "block";
            page3.style.display = "block";
            page4.style.display = "block";
            footer.style.display = "block"
        }, 2000);
        setTimeout(function () {
            upper.style.display = "none";
        }, 1500);
        setTimeout(function () {
            
        }, 1500);

        function upper_slide() {
            vyska = vyska - 0.01;
            upper.style.opacity = vyska;
			
			
				
			
        }
		function opacity_show()
		{
			opacity = opacity + 0.01;
			main.style.opacity = opacity;
			menu.style.opacity = opacity;
			 if (opacity >= 1) {
                clearInterval(timer_2)
            }
		}

        $('#tabulka > table').hide();

        function tabulka(mesto_id) {
            var tabulka = _("tabulka");
            var mesto = _(mesto_id);
            var cara = _("cara3");

            $('#tabulka > table').hide();


            if (mesto) {
                tabulka.style.display = "block";
                mesto.style.display = "table";
                cara.style.top = "0" + "px";

                $('html, body').animate({
                    scrollTop: $('#tabulka').offset().top - 80 // magic constants ftw
                }, 500);
            }

        }

    </script>

    <script>
        var $root = $('html, body');

        $('a[href^="#"]').click(function () {
            $root.animate({
                scrollTop: $($.attr(this, 'href')).offset().top
            }, 500);

            return false;
        });

        $("#main").interactive_bg({
            strength: 25,
            scale: 1.1,
            animationSpeed: "100ms",
            contain: true,
            wrapContent: false
        });
    </script>

@endsection
