<?php

namespace common\components;

class ComplexNumber { 
    private $real; 
    private $imaginary; 
  
    public function __construct($real, $imaginary) { 
        $this->real = $real; 
        $this->imaginary = $imaginary; 
    } 
  
    public function divide(ComplexNumber $complexNumber) { 
        $denominator = $complexNumber->getReal()**2  
            + $complexNumber->getImaginary()**2; 
              
        $real = ($this->real * $complexNumber->getReal()  
            + $this->imaginary * $complexNumber->getImaginary())  
            / $denominator; 
              
        $imaginary = ($this->imaginary * $complexNumber->getReal()  
            - $this->real * $complexNumber->getImaginary())  
            / $denominator; 
              
        return new ComplexNumber($real, $imaginary); 
    } 
  
    public function magnitude() { 
        return sqrt($this->real**2 + $this->imaginary**2); 
    } 
  
    public function conjugate() { 
        return new ComplexNumber($this->real, -$this->imaginary); 
    } 
      
    public function __toString() { 
        return "({$this->real}, {$this->imaginary}i)"; 
    } 
  
    public function getReal() { 
        return $this->real; 
    } 
  
    public function getImaginary() { 
        return $this->imaginary; 
    }
    
    
    ///////////////////////////
    
    public function multiply(ComplexNumber $complexNumber) { 
        $real = $this->real * $complexNumber->getReal()  
            - $this->imaginary * $complexNumber->getImaginary(); 
              
        $imaginary = $this->real * $complexNumber->getImaginary()  
            + $this->imaginary * $complexNumber->getReal(); 
              
        return new ComplexNumber($real, $imaginary); 
    } 
    
    
    public function subtract(ComplexNumber $complexNumber) { 
        return new ComplexNumber( 
            $this->real - $complexNumber->getReal(), 
            $this->imaginary - $complexNumber->getImaginary() 
        ); 
    } 
    
    
    public function add(ComplexNumber $complexNumber) { 
        return new ComplexNumber( 
            $this->real + $complexNumber->getReal(), 
            $this->imaginary + $complexNumber->getImaginary() 
        ); 
    } 
    
     
} 


?>