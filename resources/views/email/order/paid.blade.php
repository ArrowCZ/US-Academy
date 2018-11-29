<p>
    Dobrý den!<br>

    @if ($training->type == 1)
        Potvrzujeme přijetí platby za Urban Sense Workshop {{ $training->date() }} ve městě {{ $city->name }}.<br>
        V příloze Vám zasíláme fakturu za objednané služby.
    @else
        Potvrzujeme přijetí platby za pololetní parkour kroužek ({{ $training->season }}) v Urban Sense Academy!<br>
        Doklad bude vystaven na místě.
    @endif
</p>

<br>
Rekapitulace / Čas a místo: <br>
@if ($training->type == 1)
    {{ $training->date() }} {{ $training->time }}
@else
    {{ $training->day }}, {{ $training->time }}<br>
@endif

{{ $training->address }}<br>

<br>

<p>
    Pro jakékoliv dotazy nás neváhejte kontaktovat na: 773 074 651
</p>

<p>
    Těšíme se na Vás!
</p>
<p>
    S přátelským pozdravem,<br>
    Urban Sense Academy
</p>
