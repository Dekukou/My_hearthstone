<?php

$classe = array("Mage", "Chasseur", "Druide", "Paladin", "Pretre", "Voleur", "Chaman", "Demoniste", "Guerrier");
if ($argc >= 3){
echo "Pseudo du joueur: " . $argv[1] . "\n";
if (in_array($argv[2], $classe) == false)
{
echo "Classe introuvable\n";
echo "Les classes disponibles sont:\nMage\nChasseur\nDruide\nPaladin\nPretre\nVoleur\nChaman\nDemoniste\nGuerrier\n";
echo "Veuillez relancer le programme et ecrire une classe correct\n";
}
else
{
echo "Vous avez pris la classe " . $argv[2] . "\n";
$test = strtolower($argv[2]);
$i = 0;
echo "Voici les cartes disponibles : \n";
$entries = scandir(".");
$filelist = array();
foreach($entries as $entry) {
if ($entry != "my_hearthstone.php") {
if (strpos(file_get_contents($entry),$test))
$filelist[] = substr($entry, 0, -5);
}
}
foreach ($filelist as $carte)
echo $carte . "\n";
$deck_player = array();
$line = "";
while ($i != 10) {
$line = readline ('Entrer le nom de la carte a ajouter au deck: ');
if (in_array($line, $filelist)) {
$i++;
$deck_player[] = $line;
}
else
echo "Cette carte n'existe pas ou ne vous est pas disponible\n";
foreach ($filelist as $carte)
echo $carte . "\n";
echo "Vous avez " . $i . " carte(s) dans votre deck\n";
}
shuffle ($deck_player);

$name_ia = "Callaghan";
$classe_ia = $classe[array_rand($classe, 1)];

echo "Votre adversaire est " . $name_ia . " il joue la classe " . $classe_ia . "\n";

$ia_classe = strtolower($classe_ia);
foreach($entries as $entry) {
if ($entry != "my_hearthstone.php") {
if (strpos(file_get_contents($entry),$ia_classe))
$filelist_ia[] = substr($entry, 0, -5);
}
}
$deck_ia = array();
$j = 0;
while ($j != 10) {
$deck_ia[] = $filelist_ia[array_rand($filelist_ia, 1)];
$j++;
}

$pv_player = 15;
$pv_ia = 15;
$mana_player = 0;
$mana_ia = 0;

$hand_player = array();
$hand_ia = array();
$k = 0;
$l = 0;

$pioche_degat = 1;
$pioche_degat_ia = 1;

while ($line != "exit")
{
echo "\n\nIl vous reste " . $pv_player . " point(s) de vie.\n";

if ($mana_player == 0)
echo "Vous etes le premier joueur.\n";
if ($mana_player < 5)
$mana_player++;
echo "Vous avez " . $mana_player . " point(s) de mana.\n";

if ($k == 0) {
while ($k < 3) {
$hand_player[] = $deck_player[0];
array_shift($deck_player);
$k++;
}
}

if ($l == 0) {
while ($l < 4) {
$hand_ia[] = $deck_ia[0];
array_shift($deck_ia);
$l++;
}
}

if ($k < 10){
$hand_player[] = $deck_player[0];
array_shift($deck_player);
$k++;
}
if ($k == 10) {
$pv_player = $pv_player - $pioche_degat;
echo "Vous avez perdu " . $pioche_degat . " PV a cause de la fatigue\n";
$pioche_degat++;
}

echo "Vous avez en main :\n";
foreach ($hand_player as $key => $val)
echo $val . "\n";
$line = readline("$> ");

if ($l < 10){
$hand_ia[] = $deck_ia[0];
array_shift($deck_ia);
$l++;
}
if ($l == 10){
$pv_ia = $pv_ia - $pioche_degat_ia;
echo $name_ia . " a perdu " . $pioche_degat_ia . " PV a cause de la fatigue\n";
$pioche_degat_ia++;
}

echo $name_ia . " a encore " . $pv_ia. " point(s) de vie.\n";

if ($mana_ia < 5)
$mana_ia++;
echo $name_ia . " a " . $mana_ia . " point(s) de mana.\n";

if ($pv_ia <= 0)
{
echo "Les PV de votre adversaire sont passes a " . $pv_ia  . "\n";
echo "Vous avez gagne\n";
$line = "exit";
}
if ($pv_player <= 0){
echo "Vos PV sont passes a " . $pv_player . "\n";
echo "Vous avez perdu\n";
$line = "exit";
}
}
}
}
else
echo "Vous devez fournir 2 arguments : Votre Pseudo puis votre Classe\n";