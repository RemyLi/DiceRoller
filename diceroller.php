<?php

function dice($f = 6) {
  return random_int(1, $f);
}

function lunch($nb_dice = 4, $face = 6) {
  $return = [];
  for ($i = 0; $i < $nb_dice; $i++) {
    $return[] = dice($face);
  }
  return $return;

  //  return [
  //    'blue'   => dice(6),
  //    'with'   => dice(6),
  //    'red'    => dice(6),
  //    'yellow' => dice(6),
  //  ];
}

function sum($lunch) {
  return array_sum($lunch);
}

$NB_DICE = 5;
$NB_FACE = 6;
$NB_LUNCH = 1000000;

$res = [];
for ($i = 0; $i < $NB_LUNCH; $i++) {
  $res[] = lunch($NB_DICE, $NB_FACE);
}

$repartition = [];
$repartition_combinaison = [];

for ($i = $NB_DICE; $i <= ($NB_FACE * $NB_DICE); $i++) {
  $repartition[$i] = 0;
}

foreach ($res as $lunch) {
  $sum = sum($lunch);
  sort($lunch);
  $combinaison = implode('|', $lunch);
  if (empty($repartition[$sum])) {
    $repartition[$sum] = 0;
  }
  if (empty($repartition_combinaison[$combinaison])) {
    $repartition_combinaison[$combinaison] = 0;
  }
  $repartition[$sum]++;
  $repartition_combinaison[$combinaison]++;
}

var_export($repartition_combinaison);
var_export($repartition);


$repartition_percent = array_map(function ($v) use ($NB_LUNCH) {
  return str_pad($v, strlen("$NB_LUNCH")) . ' : ' . round(($v * 100) / $NB_LUNCH, 2) . '%';
}, $repartition);

var_export($repartition_percent);