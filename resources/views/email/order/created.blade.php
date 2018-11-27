<p>
    Dobrý den!<br>

    @if ($training->type == 1)
        právě jste se přihlásili na náš parkourový workshop Urban Sense {{ $training->date() }} ve městě {{ $city->name }}.
    @elseif ($training->type == 2)
        právě jste si rezervovali místo na příměstském táboře Urban Sense
        ve městě {{ $city->name }} v termínu {{ $training->date() }} - {{ $training->dateTo() }}.
    @else
        @if ($was_sub)
            Právě se uvolnilo místo na parkour kroužek v Urban Sense Academy
        @else
            Právě jste se přihlásili do Urban Sense Academy na parkour kroužek
        @endif

        ve městě {{ $city->name }}.
        Objednaný kroužek zahrnuje pravidelné jednohodinové tréninky od {{ $training->season }}.
    @endif
</p>

@if ($training->type == 1)
@elseif($training->type == 2)
@else
    <p>
        Čas a místo: <br>
        {{ $training->day }}, {{ $training->time }}<br>
        {{ $training->address }}<br>
    </p>
@endif


<br>

@if ($training->type == 1)
    <p>
        Pro dokončení registrace na Urban Sense Workshop prosím uhraďte poplatek ve výši {{ $order->price }},- do
        5-ti dnů od přihlášení.
    </p>
@elseif ($training->type == 2)
    <p>
        Brzy Vám zašleme na Vámi uvedený e-mail přesný program tábora a veškeré informace s doplňujícími formuláři
        nezbytné pro úplnou registraci na příměstský tábor.
    </p>
@else
    <p>
        Pro úplnou registraci do Urban Sense Academy je potřeba provést platbu za kroužek do 5-ti dnů od přijetí tohoto e-mailu.
    </p>
@endif


@if ($training->type != 2)
    <p>
        Instrukce pro provedení platby:<br>
        <br>
        Částka: {{ $order->price }},-<br>

        @if ($training->type == 1)
            Číslo účtu: 2501178527/2010 <br>
            IBAN: CZ5020100000002501178527 <br>
            BIC/SWIFT: FIOBCZPPXXX <br>
        @else
            @if ($city->name === 'Jihlava')
                Číslo účtu: 2001483613/2010 <br>
                IBAN: CZ3920100000002001483613 <br>
                BIC/SWIFT: FIOBCZPPXXX <br>
            @else
                Číslo účtu: 2901483600/2010 <br>
                IBAN: CZ1020100000002901483600 <br>
                BIC/SWIFT: FIOBCZPPXXX <br>
            @endif
        @endif

        Variabilní symbol: {{ $order->id }}<br>
    </p>
@else
    <p>
        Vaše účast na příměstském táboře je platná od zaslání platby {{ $order->price }},- .
        <br>
        Informace k platbě Vám zašleme společně se zbytkem informačních dokumentů.
    </p>
@endif

@if ($training->type == 1)
    <p>
        V příloze naleznete program celého workshopu a formulář, který je nutné vyplnit, podepsat a
        přinést sebou vytištěný na workshop! Bez něj se není možné workshopu zúčastnit.
    </p>
    <p>
        V případě dotazů nás neváhejte kontaktovat: +420 725 980 860 - Marek Klátil (organizátor)
    </p>
    <p>
        Těšíme se na Vás, <br>
        organizační tým Urban Sense Academy
    </p>
@elseif ($training->type == 2)
    <br>
    <p>
        S přátelským pozdravem,<br>
        Urban Sense Academy
    </p>
@else
    <p>
        V momentě přijetí Vaší platby Vám zašleme potvrzovací e-mail.<br>
        Pro jakékoliv dotazy nás neváhejte kontaktovat na: 773 074 651
    </p>
    <br>
    <p>
        S přátelským pozdravem,<br>
        Urban Sense Academy
    </p>

@endif




