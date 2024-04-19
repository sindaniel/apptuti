<?php

namespace App\View\Components;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HumanDate extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $date)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $date = Carbon::parse($this->date);
        //spanis days array
        $days = [
            "Domingo",
            "Lunes",
            "Martes",
            "Miércoles",
            "Jueves",
            "Viernes",
            "Sábado"
        ];
          
       

        $months = [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ];

        //format date Lunes 12 de Julio
        $format = $days[$date->dayOfWeek] . ' ' . $date->day . ' de ' . $months[$date->month - 1];

        return view('components.human-date', ['format' => $format]);
    }
}
