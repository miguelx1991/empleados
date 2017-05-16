<?php
    class ClearPar {
        /* Member variables */
        var $PCCadena;
        
        function setCadena($tcCadena){
         $this->PCCadena = $tcCadena;
        }
        
        function getCadena(){
         echo $this->PCCadena;
        }
        
        function QuitarCaracteres()
        {
            $lcCadena = $this->PCCadena;
            $lnNumPos = 0;
            $lcCadena = "";
            
            $str = str_replace("()", "", $this->PCCadena, $count);
            
            for($i = 0; $i < $count; $i++)
            {
                $lcCadena .= "()";
            }            
            
            echo $lcCadena;
        }
   }