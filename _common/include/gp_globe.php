<?php
//  ------------------------------------------------------------------------ //
//            JJD-BIBLIO - Biblioth�que de fonction pour modules             //
//                Utilis�es nottamment par Lexique et HErmes                 //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://xoops.kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************

 
Copyright (C) 2007 Jean-Jacques DELALANDRE 
Ce programme est libre, vous pouvez le redistribuer et/ou le modifier selon les termes de la Licence Publique G�n�rale GNU publi�e par la Free Software Foundation (version 2 ou bien toute autre version ult�rieure choisie par vous). 

Ce programme est distribu� car potentiellement utile, mais SANS AUCUNE GARANTIE, ni explicite ni implicite, y compris les garanties de commercialisation ou d'adaptation dans un but sp�cifique. Reportez-vous � la Licence Publique G�n�rale GNU pour plus de d�tails. 

Vous devez avoir re�u une copie de la Licence Publique G�n�rale GNU en m�me temps que ce programme ; si ce n'est pas le cas, �crivez � la Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307, +tats-Unis. 

Cr�ation avril 2006
Derni�re modification : septembre 2007
******************************************************************************/


include_once ("debugTools.php");


//***************************************************************
//Assemblage des deux tableaux post et get pour n'e gerer qu'un
//c'est le post qui es priorise en cas de cl� similaire
$gepeto = array_merge ($_POST, $_GET);

//verifie que le liste des nom de variale a globaliser existe
//ce doit �tre un tableau de tableau avec les cles 'name et eventuellement 'defautlt'
if (isset($vars)){
   
  for ($h = 0; $h < count($vars); $h++){
    $v = $vars[$h];
    $n = $v['name'];   
    
 
    if (isset($gepeto[$n])){
      //la cle existe on cre la variable � globaliser et on affecte la valeur 
      $$n = $gepeto[$n]; 

    }else{
      //la cle n'existe pas on verifie qu'une valeur par defaut a ete defini
      if (isset($v['default'])){
        //affecte la valeur par defaut
        $$n = $v['default'];      
      }else{
        //pas de bol, initialistion avec une chaine vide par defaut
        $$n = '';      
      }
      $gepeto[$n] = $$n;
    }

  }
}else{
      $gepeto = array ();
}
//--------------------------------------------------------
// si la cle pinochio n'existe pas on l'ajoute
// ca n'a d'interet que pour debuger, ca permet d'aficher le tableau gepeto
if (!array_key_exists ( 'pinochio', $gepeto)) {
  $pinochio = false;
  $gepeto['pinochio'] = $pinochio;
}

//affichage pour debugage du tableau ainsi constitu�
if ($pinochio) {
    //displayArray2 ($_POST, '--- gepeto : POST ---------');
    //displayArray2 ($_GET, '--- gepeto  : GET ---------');
    //displayArray2 ($gepeto, '--- gepeto : POST + GET selon liste de nom ---------');


    displayArray ($_POST, '--- gepeto : POST ---------');
    displayArray ($_GET, '--- gepeto  : GET ---------');
    displayArray ($gepeto, '--- gepeto : POST + GET selon liste de nom ---------');

}  




?>
