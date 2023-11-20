<?php
require_once('config.php');
 $daniel = new Usuario;
$daniel->loadById(1002);

echo $daniel;

echo "<br/> <br/>";
$tabela = Usuario::getList();
echo json_encode($tabela); 

echo "<br/> <br/>";
$busca = Usuario::Search("da");
echo json_encode($busca);

echo "<br/> <br/>";
$pessoa = new Usuario();
$pessoa->setUser('lucas','1865');
echo $pessoa;
echo '<br/>';
echo $pessoa->getColum('dessenha');

/*echo "<br/> <br/>";
$usern = new Usuario('FELICIANO', '@!$%');
$usern->insert();
echo $usern;
*/

echo "<br/> <br/>";
$sauer = new Usuario();
$sauer->LoadById(2002);
$sauer->update("Fernx", "julio123@");

echo $sauer;


echo "<br/> <br/>";
$d1 = new Usuario();
$d2 = new Usuario();
$d1->LoadById(2009);
$d2->LoadById(2023);
$d1->delete();
$d2->delete();

?>