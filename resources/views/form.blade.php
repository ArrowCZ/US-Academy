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
            <div id="logo_menu"><a href="/"><img src="{{ asset('images/logo.png') }}" alt="logo" draggable="false"></a>
            </div>
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
            <h1>

                @if ($training->type == 1)
                    PŘIHLÁSIT SE NA WORKSHOP
                @elseif ($training->type == 2)
                    REZERVACE NA KEMP
                @else
                    PŘIHLÁSIT @if ($training->free_count()) SE @else NÁHRADNÍKA @endif NA KROUŽEK
                @endif
            </h1>
        </div>

        <div id="formular">
            <form action="/form/{{$training->id}}" id="forma" method="POST">
                @csrf
                @method('POST')

                <p>JMÉNO A PŘIJMENÍ</p><br>

                <input
                    type="text"
                    class="pole"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                >

                <br><br>

                <p>JMÉNO A PŘIJMENÍ ZÁKONNÉHO ZÁSTUPCE</p><br>

                <input
                    type="text"
                    class="pole"
                    name="parent"
                    value="{{ old('parent') }}"
                >

                <br><br>

                <div class="row">
                    <div class="col">
                        <p class="next">E-MAIL</p><br><br>
                        <input
                            type="email"
                            class="pole"
                            name="email"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>
                    <div class="col">
                        <p class="next">TELEFON</p><br><br>
                        <input
                            type="tel"
                            class="pole"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                        >
                    </div>
                </div>

                @if ($training->type == 2)
                    <br>

                    <div class="row">
                        <div class="col">
                            <p class="next">MĚSTO</p><br><br>
                            <input
                                type="text"
                                class="pole"
                                name="city"
                                value="{{ old('city') }}"
                                required
                            >
                        </div>
                        <div class="col">
                            <p class="next">PSČ</p><br><br>
                            <input
                                type="text"
                                class="pole"
                                name="postal_code"
                                value="{{ old('postal_code') }}"
                                required
                            >
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <p class="next">ULICE A Č.P.</p><br><br>
                            <input
                                type="text"
                                class="pole"
                                name="street"
                                value="{{ old('street') }}"
                                required
                            >
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <p class="next">FIRMA</p><br><br>
                            <input
                                type="text"
                                class="pole"
                                name="company"
                                value="{{ old('company') }}"
                            >
                        </div>
                        <div class="col">
                            <p class="next">IČ</p><br><br>
                            <input
                                type="text"
                                class="pole"
                                name="tin"
                                value="{{ old('tin') }}"
                            >
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <p class="next">POJIŠŤOVNA</p><br><br>
                            <input
                                type="text"
                                class="pole"
                                name="insurance"
                                value="{{ old('insurance') }}"
                                required
                            >
                        </div>
                        <div class="col">
                            <p class="next">RODNÉ ČÍSLO ÚČASTNÍKA</p><br><br>
                            <input
                                type="text"
                                class="pole"
                                name="pid_number"
                                value="{{ old('pid_number') }}"
                                required
                            >
                        </div>
                    </div>

                    <br>

                    <p>ZDRAVOTNÍ OMEZENÍ</p><br>

                    <textarea
                        id="message"
                        class="pole"
                        rows="3"
                        name="condition"
                    >{{ old('condition') }}</textarea>

                    <br>

                @endif

                <br>

                <p>VÁŠ TEXT</p><br>

                @if ($training->type == 2)
                    <textarea
                        id="message"
                        class="pole"
                        rows="10"
                        name="text"
                        placeholder="Odkud jste se dozvěděli o Urban Sense Academy táboru?"
                    >{{ old('text') }}</textarea>
                @else
                    <textarea
                        id="message"
                        class="pole"
                        rows="10"
                        name="text"
                        placeholder="Odkud jste se dozvěděli o Urban Sense Academy? Co očekáváte od tréninku? Jaké jsou Vaše zkušenosti s parkourem?"
                    >{{ old('text') }}</textarea>
                @endif



                <br>
                <br>

                <label class="checkbox">
                    <input type="checkbox" class="gdpr" required> Souhlasím se
                </label>
                <a href="{{ route('legal') }}" target="_blank" class="gdpr">zpracováním osobních údajů.</a><br>
                <br>

                <label class="checkbox">
                    <input type="checkbox" class="gdpr" id="terms" required> Souhlasím s
                </label>
                <a href="{{ route('terms') }}" target="_blank" class="gdpr">podmínkami Urban Sense Academy.</a><br>


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
                <p><a href="/legal" class="no-decor" style="color:#666666">zpracování a ochrana osobních údajů</a><br>
                    <a href="{{ route('terms') }}" class="no-decor" style="color:#666666">podmínky Urban Sense
                        Academy</a>
                </p>
            </div>
            <div id="author">
                <p>Webdesign by <a href="http://www.tomeno.cz" class="no-decor"><img
                            src="{{ asset('images/tomeno.png') }}"></a></p>
            </div>
        </div>
    </div>
@endsection
