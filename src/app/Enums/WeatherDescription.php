<?php

namespace App\Enums;

enum WeatherDescription: string
{
    case Rain = "Take an umbrella, it's raining outside";
    case Tornado = "There's a tornado outside, better stay home";
    case Drizzle = "It's drizzling outside, an umbrella might come in handy.";

    public static function getValueByName(string $name): string
    {
        $allCases = self::cases();
        $value = '';
        foreach ($allCases as $case) {
            if ($case->name === $name) {
                $value = $case->value;
                break;
            }
        }

        return $value;
    }
}
