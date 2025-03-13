<?php

  require_once 'app/Models/model.ticket.php';
  require_once 'app/Models/model.usager.php';

  function ticket() {
    $ticketManager = new TicketManager();
    $usagerManager = new UsagerManager();

    $ticket = $ticketManager->getAll();

    $tabTicket = [];
    foreach ($ticket as $value) {
      $ticketFull = [
        'id' => $value->id_ticket(),
        'usager' => $usagerManager->get($value->id_carte())->nom(),
        'date_achat' => $value->date_achat(),
      ];
      $tabTicket[] = $ticketFull;
    }

    require 'app/Views/view.ticket.php';

  }

?>
