<p>
    Dobrý den!<br>

    Právě jste se přihlásili do Urban Sense Academy na parkour kroužek ve městě {{ $city->name }}.
    Objednaný kroužek zahrnuje pravidelné jednohodinové tréninky od {{ $training->season }}.
</p>

<br>
Čas a místo: <br>
{{ $training->day }}, {{ $training->time }}<br>
{{ $training->address }}<br>

<br>

<p>
    Pro úplnou registraci do Urban Sense Academy je potřeba provést platbu za kroužek do 5-ti dnů od přijetí tohoto e-mailu.
</p>

<p>
    Instrukce pro provedení platby:<br>
    <br>
    Částka: {{ $order->price }},-<br>

    @if ($city->name === 'Jihlava')
        Číslo účtu: 2001483613 <br>
        IBAN: CZ3920100000002001483613 <br>
        BIC/SWIFT: FIOBCZPPXXX <br>
    @else
        Číslo účtu: 2901483600/2010 <br>
        IBAN: CZ1020100000002901483600 <br>
        BIC/SWIFT: FIOBCZPPXXX <br>
    @endif

    Variabilní symbol: {{ $order->id }}<br>
</p>

<p>
    V momentě přijetí Vaší platby Vám zašleme potvrzovací e-mail.<br>
    Pro jakékoliv dotazy nás neváhejte kontaktovat na: 773 074 651
</p>
<br>
<p>
    S přátelským pozdravem,<br>
    Urban Sense Academy
</p>
