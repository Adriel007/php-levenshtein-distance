<?php

class LevenshteinDistance
{
    public function levenshteinDistance($str1, $str2)
    {
        $len1 = strlen($str1);
        $len2 = strlen($str2);

        $matrix = array();
        for ($i = 0; $i <= $len1; $i++) {
            $matrix[$i] = array();
            $matrix[$i][0] = $i;
        }
        for ($j = 0; $j <= $len2; $j++) {
            $matrix[0][$j] = $j;
        }

        for ($i = 1; $i <= $len1; $i++) {
            for ($j = 1; $j <= $len2; $j++) {
                $cost = ($str1[$i - 1] == $str2[$j - 1]) ? 0 : 1;
                $matrix[$i][$j] = min(
                    $matrix[$i - 1][$j] + 1,

                    $matrix[$i][$j - 1] + 1,

                    $matrix[$i - 1][$j - 1] + $cost

                );
            }
        }

        $distance = $matrix[$len1][$len2];
        $averageLength = (strlen($str1) + strlen($str2)) / 2;
        $maxLength = max(strlen($str1), strlen($str2));

        $normalizedDistanceAverage = ($distance / $averageLength) * 10;

        $normalizedDistanceMax = ($distance / $maxLength) * 10;

        return ['average' => $normalizedDistanceAverage, 'max' => $normalizedDistanceMax, 'distance' => $distance];
    }
}