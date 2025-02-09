<?php
namespace App\Enums;

class WeekDaysEnum {
    const DOMINGO = 0;
    const SEGUNDA = 1;
    const TERCA = 2;
    const QUARTA = 3;
    const QUINTA = 4;
    const SEXTA = 5;
    const SABADO = 6;

    public static function getName(int $day): string {
        $days = [
            self::DOMINGO => 'Domingo',
            self::SEGUNDA => 'Segunda-feira',
            self::TERCA => 'Terça-feira',
            self::QUARTA => 'Quarta-feira',
            self::QUINTA => 'Quinta-feira',
            self::SEXTA => 'Sexta-feira',
            self::SABADO => 'Sábado',
        ];

        return $days[$day] ?? 'Desconhecido';
    }
}
