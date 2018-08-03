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
            <div id="fb_logo"> <a href=""> <img src="{{ asset('images/fb_logo.png') }}" alt="logo" draggable="false"> </a></div>
            <div id="ig_logo"> <a href=""><img src="{{ asset('images/ig.png') }}" alt="logo" draggable="false"></a> </div>
        </div>
    </div>
	<div id="detail-page">
		 <div id="cara4"></div>
		 <div class="detail-nadpis nadpis1" >
			<h1>PARKOUR KROUŽEK ČESKÉ BUDĚJOVICE</h1><br>
			<div class="cena nadpis1">
				<h1>3100 Kč</h1>
			</div>
		 </div>
		 <div id="info-detail">
			<div class="blok">
				<div class="blok-text" id="cas">
					<p><b>ČAS</b><br><span>16:00 - 18:00</span></p>								
				</div>
			</div>
			<div class="blok">
				<div class="blok-text" id="den">
					<p><b>DEN KROUŽKU</b><br><span>PÁTEK</span></p>								
				</div>
			</div>
			<div class="blok">
				<div class="blok-text" id="info">
					<p><b>DOPLŇUJÍCÍ INFORMACE</b><br>Věk: 8 - 13 let<br>Náročnost pro začátečníky i pokročilé<br>Lekce: 1x týdně(55 minut)<br>Počet lekcí v prvním pololetí: 18</p>								
				</div>
			</div>
			
			<div class="blok">
				<div class="blok-text" id="trener">
					<p><b>TRENÉR</b><br><span>JAN HANKO</span></p>								
				</div>
			</div>
			<div class="blok">
				<div class="blok-text" id="mesto">
					<p><b>MĚSTO</b><br><span>ČESKÉ BUDĚJOVICE</span><br>ZŠ a MŠ Kukleny, Pražská třída<br>198/40, Hradec Králové</p>								
				</div>
			</div>
			<div class="blok">
				<div class="blok-text" id="mista">
					<p><b>VOLNÁ MÍSTA</b><br><span>22 VOLNÝCH MÍST</span></p>								
				</div>
			</div>
		 </div>
		 <div class="button_prihlasit" id="detail-button"> <p>PŘIHLÁSIT SE NA KROUŽEK</p></div>
	</div>
	<div id="mapa_detail">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118468.3835912162!2d14.444662333816865!3d48.99524599773408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47734fb43a5f629b%3A0x400af0f6614de80!2zxIxlc2vDqSBCdWTEm2pvdmljZQ!5e0!3m2!1scs!2scz!4v1533296011968"  frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
	<div id="footer" style="display:block; top:0;">
        <div id="footer-text">
            <div id="copyright">
                <p>Copyright © Urbansenseacademy 2018</p>
            </div>
            <div id="udaje">
                <p><a href="legal.html" class="no-decor" style="color:#666666">zpracování a ochrana osobních údajů</a></p>
            </div>
            <div id="author">
                <p>Webdesign by <a href="http://www.tomeno.cz" class="no-decor"><img src="{{ asset('images/tomeno.png') }}"></a> </p>
            </div>
        </div>
    </div>
@endsection
