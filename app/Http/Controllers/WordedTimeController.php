<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WordedTimeController extends Controller {
    const GREY = "\e[0;90m";
    const WHITE = "\e[1;37m";

    public static function getTimeZoneFromIp(string $ip = null): string {
        $ip ??= $_SERVER['REMOTE_ADDR'];
        $cacheKey = "WordedTimeController:getTimeZoneFromIp:$ip";

        if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return date_default_timezone_get();
        }

        return Cache::remember($cacheKey, 60 * 60 * 4, function () use ($ip) {
            $ipInfo = file_get_contents("http://ip-api.com/json/$ip");
            $ipInfo = json_decode($ipInfo);
            return $ipInfo->timezone ?? date_default_timezone_get();
        });
    }

    public function view(Request $request) {
        if ($request->header('Accept') == 'text/ansi') {
            date_default_timezone_set(self::getTimeZoneFromIp());

            for ($i = 1; $i <= 12; $i++) {
                ${"h$i"} = false;
            }

            $minute = round(date('i') / 5) * 5;
            $hour = round(date('H') + (($minute - 1) / 60));

            if ($hour == 24) {
                $hour = 0;
            } else if ($hour == 0) {
                $hour = 12;
            }

            $morning = $hour < 12;

            if ($hour > 12) {
                $hour = $hour - 12;
            }

            $almost = date('i') % 5 >= 3;
            $justAfter = date('i') % 5 < 3 && date('i') % 5 != 0;

            $ten = $minute == 10 || $minute == 50;
            $quarter = $minute == 15 || $minute == 45;
            $twenty = $minute == 20 || $minute == 40 || $minute == 25 || $minute == 35;
            $five = $minute == 5 || $minute == 25 || $minute == 35 || $minute == 55;

            $to = $minute > 30 && $minute <= 55;
            $after = $minute >= 5 && $minute < 30;

            ${"h$hour"} = true;

            $oclock = ($minute == 0 || $minute == 60) && $hour != 12;
            $thirty = $minute == 30;

            $midNight = false;
            $afternoon = false;
            $inThe = false;
            $evening = false;

            if ($morning && $hour == 12 && $minute > 30) {
                $morning = false;
                $midNight = true;
            } else if ($morning) {
                $inThe = true;
                $morning = true;
            } else if ($hour == 12 && $minute > 30) {
                $noon = true;
            } else if ($hour < 6 || $hour == 12) {
                $inThe = true;
                $afternoon = true;
            } else { // if ($hour >= 6 && $hour < 10) {
                $inThe = true;
                $evening = true;
                // } else {
                //     $(".atNight = true;
            }

            $result = self::WHITE . 'IT' . self::GREY . 'R' . self::WHITE . 'IS' . self::GREY . 'ER';

            if ($request->has('precise')) {
                if ($justAfter) $result .= self::WHITE;
                $result .= 'JUST';
                if ($justAfter) $result .= self::GREY;
                $result .= 'G';
                if ($justAfter) $result .= self::WHITE;
                $result .= 'AFTER';
                if ($justAfter) $result .= self::GREY;
                $result .= "H\n";
                if ($almost) $result .= self::WHITE;
                $result .= 'ALMOST';
                if ($almost) $result .= self::GREY;
                $result .= 'X';
            }

            if ($ten) $result .= self::WHITE;
            $result .= 'TEN';
            if ($ten) $result .= self::GREY;
            $result .= 'R';
            if ($quarter) $result .= self::WHITE;
            $result .= "QUARTER";
            if ($quarter) $result .= self::GREY;
            $result .= "\n";

            if ($twenty) $result .= self::WHITE;
            $result .= 'TWENTY';
            if ($twenty) $result .= self::GREY;
            $result .= 'A';
            if ($five) $result .= self::WHITE;
            $result .= 'FIVE';
            if ($five) $result .= self::GREY;
            $result .= 'YP';
            if ($after) $result .= self::WHITE;
            $result .= "AFTER";
            if ($after) $result .= self::GREY;
            $result .= "\n";

            if ($to) $result .= self::WHITE;
            $result .= 'TO';
            if ($to) $result .= self::GREY;
            $result .= 'V';
            if ($h1) $result .= self::WHITE;
            $result .= 'ONE';
            if ($h1) $result .= self::GREY;
            $result .= 'D';
            if ($h2) $result .= self::WHITE;
            $result .= 'TWO';
            if ($h2) $result .= self::GREY;
            $result .= 'Q';
            if ($h6) $result .= self::WHITE;
            $result .= 'SIX';
            if ($h6) $result .= self::GREY;
            if ($h4) $result .= self::WHITE;
            $result .= 'FOUR';
            if ($h4) $result .= self::GREY;
            $result .= "\n";

            if ($h10) $result .= self::WHITE;
            $result .= 'TE';
            if ($h9) $result .= self::WHITE;
            $result .= 'N';
            if ($h10) $result .= self::GREY;
            $result .= 'INE';
            if ($h9) $result .= self::GREY;
            if ($h5) $result .= self::WHITE;
            $result .= 'FIV';
            if ($h8) $result .= self::WHITE;
            $result .= 'E';
            if ($h5) $result .= self::GREY;
            $result .= 'IGH';
            if ($h3) $result .= self::WHITE;
            $result .= 'T';
            if ($h8) $result .= self::GREY;
            $result .= "HREE";
            if ($h3) $result .= self::GREY;
            $result .= "\n";

            if ($h7) $result .= self::WHITE;
            $result .= 'SEVEN';
            if ($h7) $result .= self::GREY;
            if ($h12) $result .= self::WHITE;
            $result .= 'TWELVE';
            if ($h12) $result .= self::GREY;
            $result .= 'S';
            if ($h11) $result .= self::WHITE;
            $result .= 'ELEVEN';
            if ($h11) $result .= self::GREY;
            $result .= "\n";

            if ($oclock) $result .= self::WHITE;
            $result .= 'OCLOCK';
            if ($oclock) $result .= self::GREY;
            if ($midNight) $result .= self::WHITE;
            $result .= 'MID';
            if ($midNight) $result .= self::GREY;
            $result .= 'E';
            if ($thirty) $result .= self::WHITE;
            $result .= 'THIRTY';
            if ($thirty) $result .= self::GREY;
            $result .= "ED\n";

            if ($inThe) $result .= self::WHITE;
            $result .= 'IN';
            if ($inThe) $result .= self::GREY;
            $result .= 'A'; // was part of AT for NIGHT
            if ($inThe) $result .= self::WHITE;
            $result .= 'THE';
            if ($inThe) $result .= self::GREY;
            if ($midNight) $result .= self::WHITE;
            $result .= 'NIGHT';
            if ($midNight) $result .= self::GREY;
            if ($morning) $result .= self::WHITE;
            $result .= 'MORNING';
            if ($morning) $result .= self::GREY;
            $result .= "\n";

            if ($afternoon) $result .= self::WHITE;
            $result .= 'AFTERNOON';
            if ($afternoon) $result .= self::GREY;
            $result .= 'DA';
            if ($evening) $result .= self::WHITE;
            $result .= 'EVENING';
            if ($evening) $result .= self::GREY;
            $result .= "\n";

            return response($result, headers: [
                'Content-Type' => 'text/ansi',
            ]);
        } else {
            return view('pages.project.worded-time');
        }
    }
}
