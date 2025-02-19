<?php
namespace App\Enums;

class StatusEnum {
    const PENDENTE = "pending";
    const CONFIRMADO = "confirmed";
    const CANCELADO = "canceled";
    
    public static function getName(string $status): string {
        $statuses = [
            self::PENDENTE => 'Pendente',
            self::CONFIRMADO => 'Confirmado',
            self::CANCELADO => 'Cancelado',
        ];
        return $statuses[$status] ?? 'Desconhecido';
    }
}
