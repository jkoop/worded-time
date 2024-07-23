function uiop() {
    now = new Date();
    hour = now.getHours();
    minute = now.getMinutes();
    almost = minute % 5;
    minute = Math.round(minute / 5) * 5;
    hour = Math.round(hour + (minute - 1) / 60);
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
    } else {
        // if (hour >= 6 && hour < 10) {
        $(".inThe").addClass("on");
        $(".evening").addClass("on");
        // } else {
        //     $(".atNight").addClass("on");
    }
}

$(document).ready(uiop);
setInterval(uiop, 1000);

$("#precise").toggle($("#preciseCheckbox").prop("checked"));

$("#preciseCheckbox").click(() => {
    $("#precise").toggle($(this).prop("checked"));
});
