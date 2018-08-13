@extends('layouts.web')

@section('content')
    <div id="menu" style="display: block">
        <div id="left">

            <ul id="nav-take">
                <li class=""><a href="/"> O NÁS </a></li>
                <li class=""><a href="/"> VÝBĚR KROUŽKŮ </a></li>
                <li class=""><a href="/"> KONTAKT </a></li>

            </ul>
        </div>
        <div id="middle">
            <div id="logo_menu"><img src="{{ asset('images/logo.png') }}" alt="logo" draggable="false"></div>
        </div>
        <div id="right">
            <div id="fb_logo"><a href="https://www.facebook.com/Urban-Sense-Academy-1621345168099222/"> <img
                        src="{{ asset('images/FB-IC.svg') }}" alt="logo" draggable="false"> </a></div>
            <div id="ig_logo"><a href="https://www.instagram.com/urbansenseacademy/"><img
                        src="{{ asset('images/IG-IC.svg') }}" alt="logo" draggable="false"></a></div>
        </div>
    </div>
	
	<div id="form-page">
	
		<div class="nadpis1" id="form-nadpis">
		
			<h1>PŘIHLÁSIT SE NA KROUŽEK</h1>
		
		</div>
		<div id="formular">
            <form action="/form/{{$training->id}}" id="forma" method="POST">
                @csrf
                @method('POST')

                <p id="last_first_name">JMÉNO A PŘIJMENÍ</p><br>

                <input
                    type="text"
                    class="pole"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                >

                <br>
                <br>

                <div class="row">
                    <div class="col">
                        <p class="next" id="mail_text">E-MAIL</p>
                        <input
                            type="email"
                            class="pole"
                            name="email"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>
                    <div class="col">
                        <p class="next">TELEFON</p>
                        <input
                            type="tel"
                            class="pole"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                        >
                    </div>
                </div>

                <br>

                <p id="your_text">VÁŠ TEXT</p><br>

                <textarea id="message" class="pole" rows="10" name="text" >{{ old('text') }}</textarea>

                <br>
                <br>

                <label class="checkbox">
                    <input type="checkbox" id="gdpr" required> Souhlasím se
                </label>
                 <a href="{{ route('legal') }}" target="_blank">zpracováním osobních údajů.</a><br>
                <br>

                <label class="checkbox">
                    <input type="checkbox" id="terms" required> Souhlasím s
                </label>
                <a href="{{ route('terms') }}" target="_blank">podmínkami Urban Sense Academy.</a><br>


                <input type="submit" value="ODESLAT" id="button-form">
            </form>

			{{--<form id="forma">--}}
			{{--<p id="last_first_name">JMÉNO A PŘIJMENÍ</p><br>--}}
			{{--<input type="text" id="jmeno" class="pole" required><br><br><br>--}}
			{{--<p class="next" id="mail_text">E-MAIL</p><p class="next" id="tel"> TELEFON</p><br><br>--}}
			{{--<input type="text" id="email" class="pole" type="email" required>--}}
			{{--<input type="text" id="telefon" class="pole" required><br><br>--}}
			{{--<p id="your_text">VÁŠ TEXT</p><br>--}}
			{{--<textarea id="message" class="pole" rows="10" ></textarea> <br><br>--}}
			{{--<input type="checkbox" id="gdpr" required> <p id="gdpr">Souhlasím se <a href="/legal">zpracováním osobních údajů.</a></p><br>--}}
			{{--<input type="submit" value="ODESLAT" id="button-form">--}}
			{{--</form>--}}
		</div>
	</div>
	
    <div id="footer" style="display:block; top:0;">
        <div id="footer-text">
            <div id="copyright">
                <p>Copyright © Urbansenseacademy 2018</p>
            </div>
            <div id="udaje">
                <p><a href="/legal" class="no-decor" style="color:#666666">zpracování a ochrana osobních údajů</a>
                </p>
            </div>
            <div id="author">
                <p>Webdesign by <a href="http://www.tomeno.cz" class="no-decor"><img
                            src="{{ asset('images/tomeno.png') }}"></a></p>
            </div>
        </div>
    </div>
@endsection
