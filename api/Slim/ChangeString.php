<?php
    class ChangeString {
        /* Member variables */
        var $PCCadena;
        
        function setCadena($tcCadena){
         $this->PCCadena = $tcCadena;
        }
        
        function getCadena(){
         echo $this->PCCadena;
        }
        
        function ConvertirCadena()
        {
            $lcCadena = $this->PCCadena;
            $lnNumCar = 0;
            $lcCadRet = "";
            $lcPatron = "/^[a-z]+$/i";
            for($i = 0; $i < STRLEN($lcCadena); $i++)
            {
                
                if (preg_match($lcPatron, $lcCadena[$i]))
                {
                    $lnNumCar = ord($lcCadena[$i]);
                    $lcCadRet .= chr($lnNumCar + 1);  
                }
                else
                {
                    $lcCadRet .= $lcCadena[$i];
                }             
            }
            
            echo $lcCadRet;
        }
   }