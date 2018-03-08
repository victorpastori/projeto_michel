<?php

class Investimento
{

 function __construct()
 {
   # code...
 	/* Status:  0 -> Esperando ativação
 				1 -> Ativado
 				2 -> Finalizado (Posso substituir pela exclusao) */
 }
 


 public $idinvestimento;
 public $valor;
 public $carencia;
 public $carenciaRestante;
 public $data;
 public $status;
 public $conta_idconta;
 

}


?>