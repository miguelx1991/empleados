<?php
    class CompleteRange {
        /* Member variables */
        var $PNPriVal = 0;
        var $PNSegVal = 0;
        
        
        function setPriNum($tnPriNum){
         $this->PNPriVal = $tnPriNum;
        }
        
        function getPriNum(){
         echo $this->PNPriVal;
        }
        
        function setSegNum($tnSegNum){
         $this->PNSegVal = $tnSegNum;
        }
        
        function getSegNum(){
         echo $this->PNSegVal;
        }
             
        
        function CompletarRango()
        {            
            $laArrNue = array();
            $lcCadena = "";
            
            for($i = $this->PNPriVal; $i <= $this->PNSegVal; $i++)
            {
                array_push($laArrNue, $i);
            }
                        
            asort($laArrNue);
                                   
            foreach ($laArrNue as $clave => $lcValor) {
                $lcCadena .= "[$clave => $lcValor]" . ',';
            }
            
            echo $lcCadena;
        }
   }