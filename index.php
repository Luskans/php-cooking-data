<?php

// $string = file_get_contents("dictionnaire.txt", FILE_USE_INCLUDE_PATH);
// $dico = explode("\n", $string);
$dico = file("dictionnaire.txt", FILE_IGNORE_NEW_LINES);
echo 'Il y a '.count($dico).' mots dans le dico. <br/>';


$number = 0;
foreach ($dico as $word) {
    if (strlen($word) == 15) {
        $number++;
    };
};
echo "Dont $number mots qui font 15 lettres de long. <br/>";


$letterw = "w";
$letterW = "W";
$number2 = 0;
foreach ($dico as $word) {
    if (strpos($word, $letterW) !== false || strpos($word, $letterw) !== false) {
        $number2++;
    };
};
echo "Ainsi que $number2 mots qui contiennent la lettre 'W'. <br/>";


$letterQ = "q";
$lastLetterArray = [];
foreach ($dico as $word) {
    $lastLetter = substr($word, -1);
    if ($lastLetter == $letterQ) {
        $lastLetterArray[] = $lastLetter;
    };
};
echo 'Et '.count($lastLetterArray).' mots qui se finissent par la lettre "Q". <br/><br/><br/>';


/////////////////////////
////////////////////////


$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
$brut = json_decode($string, true);
$top = $brut["feed"]["entry"];

///////////////////// EXERCICE 1 ////////////////////////

$count = 0;
foreach ($top as $movie) {
    if ($count < 10) {
        echo ($count+1).' '.$movie["im:name"]["label"].'<br/>';
        $count++;
    }
};
echo "<br/>";

///////////////////// EXERCICE 2 ////////////////////////

$count2 = 0;
foreach ($top as $movie) {
    $count2++;
    if ($movie["im:name"]["label"] == "Gravity") {
        echo "Le classement de Gravity est top $count2.";
    };
};
echo "<br/>";

///////////////////// EXERCICE 3 ////////////////////////

foreach ($top as $movie) {
    if ($movie["im:name"]["label"] == "The LEGO Movie") {
        echo 'Les réalisateurs du film "The LEGO Movie" sont '.$movie["im:artist"]["label"];
    };
};
echo "<br/>";

///////////////////// EXERCICE 4 ////////////////////////

$count3 = 0;
foreach ($top as $movie) {
    $relaseDates = explode("-", $movie["im:releaseDate"]["label"]);
    if ($relaseDates[0] < 2000) {
        $count3++;
    };
};
echo "Il y a $count3 films qui sont sortis avant 2020. <br/>";

///////////////////// EXERCICE 5 ////////////////////////

$dateStart = strtotime($top[0]["im:releaseDate"]["attributes"]["label"]);
$dateEnd = strtotime($top[0]["im:releaseDate"]["attributes"]["label"]);
$firstMovie = [$top[0]["im:name"]["label"], $dateStart];
$lastMovie = [$top[0]["im:name"]["label"], $dateEnd];

foreach ($top as $movie) {
    $date = strtotime($movie["im:releaseDate"]["attributes"]["label"]);
    if ($date < $dateStart) {
        $dateStart = $date;
        $firstMovie[0] = $movie["im:name"]["label"];
        $firstMovie[1] = $movie["im:releaseDate"]["attributes"]["label"];
    };
    if ($date > $dateEnd) {
        $dateEnd = $date;
        $lastMovie[0] = $movie["im:name"]["label"];
        $lastMovie[1] = $movie["im:releaseDate"]["attributes"]["label"];
    };
};
echo 'Le film le plus récent est '.$lastMovie[0].' sortie en '.$lastMovie[1].'<br/>';
echo 'Le film le plus ancien est '.$firstMovie[0].' sortie en '.$firstMovie[1].'<br/>';
// echo 'Le film le plus ancien est '.$relaseDates2[0]["im:name"]["label"].' sortie le '.$relaseDates2[0]["im:releaseDate"]["label"];


// foreach ($top as $movie) {
//     $relaseDates1 = explode("-", $movie["im:releaseDate"]["label"]);
//     $relaseDates2 = array_slice($relaseDates1, 0, 3);
//     foreach ($relaseDates2 as $relaseDate2) {
//         $relaseDates3 = intval($relaseDate2);
//     };
// };
// usort($relaseDates2, function($a, $b) {
//     for ($i = 0; $i < count($a); $i++) {
//         if ($a[$i] != $b[$i]) {
//             return $a[$i] - $b[$i];
//         };
//     };
//     return 0;
// });
// echo 'Le film le plus ancien est '.$relaseDates2[0]["im:name"]["label"].' sortie le '.$relaseDates2[0]["im:releaseDate"]["label"];

?>