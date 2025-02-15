<?php

namespace App\Utils;

class SweetAlert
{
    /*
     * Como Usar?
     * Adicione o seguinte trecho de código no inicio da tela em que o alerta deve ser exibido
     * <?php
            use App\Utils\SweetAlert;

            if (isset($_SESSION['alert'])) {
                $alert = new SweetAlert($_SESSION['alert']['type'], $_SESSION['alert']['message']);
                $alert->display();
                unset($_SESSION['alert']);
            }
        ?>
        Observação: Esse alerta será exibido na página retroativamente, ou seja, se você realizou uma edição
        em uma página feita para edição apenas, o alerta deve ser exibido na página anterior, que deve ser feito
       o redirecionamento pós edição
     */
    private $type;
    private $message;

    public function __construct(string $type, string $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    public function display(): void
    {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "' . $this->type . '",
                    title: "' . ($this->type === 'success' ? 'Sucesso!' : 'Erro!') . '",
                    text: "' . $this->message . '",
                });
            });
        </script>';
    }
}