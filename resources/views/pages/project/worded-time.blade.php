@extends('layouts.typical', [
    'lastChangedDate' => '2022-01-05',
    'allowOnlyContent' => true,
    'githubRepo' => 'jkoop/worded-time',
])
@section('title', 'worded time')
@section('description', 'display time in words by lighting up letters')

@section('content')

<!---------------------------------------------
  Worded Time copyright 2019 to 2022 Joe Koop
  Redistribution license: MIT
---------------------------------------------->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>
    pre {
        color: #EEE;
        text-align: center;
    }

    .on {
        color: #000
    }

    body.contentOnly pre {
        font-size: 7vh;
    }

    @media (orientation: portrait) {
        body.contentOnly pre {
            font-size: 7vw
        }
    }

    @media (prefers-color-scheme: dark) {
        pre {
            color: #333;
        }

        .on {
            color: white;
        }
    }
</style>

<pre>
<span class="on">IT</span>R<span class="on">IS</span>ER<span id="precise"><span class="pre justAfter">JUST</span>G<span class="pre justAfter">AFTER</span>H
<span class="pre almost">ALMOST</span>X</span><span class="pre ten">TEN</span>R<span class="pre quarter">QUARTER</span>
<span class="pre twenty">TWENTY</span>A<span class="pre five">FIVE</span>YP<span class="pre after">AFTER</span>
<span class="pre to">TO</span>V<span class="h h1">ONE</span>D<span class="h h2">TWO</span>Q<span class="h h6">SIX</span><span class="h h4">FOUR</span>
<span class="h h10">TE</span><span class="h h10 h9">N</span><span class="h h9">INE</span><span class="h h5">FIV</span><span class="h h5 h8">E</span><span class="h h8">IGH</span><span class="h h8 h3">T</span><span class="h h3">HREE</span>
<span class="h h7">SEVEN</span><span class="h h12">TWELVE</span>S<span class="h h11">ELEVEN</span>
<span class="post oclock">OCLOCK</span><span class="ofDay midNight">MID</span>E<span class="post thirty">THIRTY</span>ED
<span class="ofDay inThe">IN</span><span class="ofDay atNight">A</span><span class="ofDay inThe atNight">T</span><span class="ofDay inThe">HE</span><span class="ofDay atNight midNight">NIGHT</span><span class="ofDay morning">MORNING</span>
<span class="ofDay afternoon">AFTER</span><span class="ofDay afternoon noon">NOON</span>DA<span class="ofDay evening">EVENING</span>
</pre>
<label class="notContent"><input id="preciseCheckbox" type="checkbox" checked=""> more precision</label>

<script>
    function uiop() {
        now = new Date();
        hour = now.getHours();
        minute = now.getMinutes();
        almost = minute % 5;
        minute = Math.round(minute / 5) * 5;
        hour = Math.round(hour + ((minute - 1) / 60));
        if (hour == 24) {
            hour = 0;
        }
        if (hour < 12) {
            morning = true;
        } else {
            morning = false;
        }
        if (hour == 0) {
            hour = 12;
        }
        if (hour > 12) {
            hour = hour - 12;
        }

        $(".pre").removeClass("on");

        if (almost >= 3) {
            $(".almost").addClass("on");
        }

        if (almost < 3 && almost != 0) {
            $(".justAfter").addClass("on");
        }

        if (minute == 10 || minute == 50) {
            $(".ten").addClass("on");
        }

        if (minute == 15 || minute == 45) {
            $(".quarter").addClass("on");
        }

        if (minute == 20 || minute == 40 || minute == 25 || minute == 35) {
            $(".twenty").addClass("on");
        }

        if (minute == 5 || minute == 25 || minute == 35 || minute == 55) {
            $(".five").addClass("on");
        }

        if (minute > 30 && minute <= 55) {
            $(".to").addClass("on");
        }

        if (minute >= 5 && minute < 30) {
            $(".after").addClass("on");
        }

        $(".h").removeClass("on");
        $(".h" + hour).addClass("on");

        $(".post").removeClass("on");

        if ((minute == 0 || minute == 60) && hour != 12) {
            $(".oclock").addClass("on");
        }

        if (minute == 30) {
            $(".thirty").addClass("on");
        }

        $(".ofDay").removeClass("on");

        if (morning && hour == 12 && minute > 30) {
            $(".midNight").addClass("on");
        } else if (morning) {
            $(".inThe").addClass("on");
            $(".morning").addClass("on");
        } else if (hour == 12 && minute > 30) {
            $(".noon").addClass("on");
        } else if (hour < 6 || hour == 12) {
            $(".inThe").addClass("on");
            $(".afternoon").addClass("on");
        } else { // if (hour >= 6 && hour < 10) {
            $(".inThe").addClass("on");
            $(".evening").addClass("on");
            // } else {
            //     $(".atNight").addClass("on");
        }
    }

    $(document).ready(uiop);
    setInterval(uiop, 1000);

    $('#precise').toggle($('#preciseCheckbox').prop('checked'));

    $('#preciseCheckbox').click(() => {
        $('#precise').toggle($(this).prop('checked'));
    });
</script>

@endsection
