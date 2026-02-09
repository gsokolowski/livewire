<?php

namespace App\Livewire;

use Livewire\Component;

class Calculator extends Component
{
    public $result = 0;
    public $number1 = 0;
    public $number2 = 0;
    public $operation = '+';
    
    // Method with parameters
    public function calculate($operation)
    {
        $this->operation = $operation;
        
        switch ($operation) {
            case '+':
                $this->result = $this->number1 + $this->number2;
                break;
            case '-':
                $this->result = $this->number1 - $this->number2;
                break;
            case '*':
                $this->result = $this->number1 * $this->number2;
                break;
            case '/':
                $this->result = $this->number2 != 0 ? $this->number1 / $this->number2 : 0;
                break;
        }
    }
    
    // Method with multiple parameters
    public function setNumbers($num1, $num2)
    {
        $this->number1 = $num1;
        $this->number2 = $num2;
    }
    
    public function render()
    {
        return view('livewire.calculator');
    }
}