<?php
if (isset($_SESSION['mensagem_feedback'])) {
    $mensagem = $_SESSION['mensagem_feedback']['mensagem'];
    $type = $_SESSION['mensagem_feedback']['type'];

    // Exiba a mensagem com o estilo apropriado (por exemplo, usando classes CSS)
    echo '<div class="alert-' . $type . '">' . $mensagem . '</div>';

    unset($_SESSION['mensagem_feedback']); // Limpe a mensagem da sessão
}
