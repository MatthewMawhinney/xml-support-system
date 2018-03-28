<?php

class Ticket {

    public function getTicketsUser() {
        //populate xml table of open tickets made by logged in user
        $xml = new DOMDocument;
        $xml->load('xml/tickets.xml');
        $xsl = new DOMDocument;
        $xsl->load('xml/tickets.xsl');
        $proc = new XSLTProcessor;
        $proc->importStyleSheet($xsl);
        $proc->setParameter('', 'userId', $_SESSION['userId']);
        $displayTick = $proc->transformToXML($xml);
        return $displayTick;
    }
    public function getTicketsAdmin() {
        $xml = new DOMDocument;
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput = true;
        $xml->load('xml/tickets.xml');
        $xsl = new DOMDocument;
        $xsl->load('xml/adminTickets.xsl');
        $proc = new XSLTProcessor;
        $proc->importStyleSheet($xsl);
        $displayTick = $proc->transformToXML($xml);
        return $displayTick;
    }
    public function getTicketDetails() {
        $xml = new DOMDocument;
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput = true;
        $xml->load('xml/tickets.xml');
        $xsl = new DOMDocument;
        $xsl->load('xml/ticketDetails.xsl');
        $proc = new XSLTProcessor;
        $proc->importStyleSheet($xsl);
        $proc->setParameter('', 'ticketId', $_SESSION['ticketId']);
        $proc->setParameter('', 'userRole', $_SESSION['role']);
        $ticketInfo = $proc->transformToXML($xml);
        return $ticketInfo;
    }
    public function addMessage($msg) {
        $xml = new DOMDocument;
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput = true;
        $xml->load('xml/tickets.xml');
        $root = $xml->getElementsByTagName('ticket')->item($_SESSION['ticketId'] - 1);
        $existingMsg = $root->getElementsByTagName('messages')->item(0);
        $message = $xml->createElement('supportMsg', $msg);
        $userId = $xml->createAttribute('userId');
        $userId->value = $_SESSION['userId']; //*VARAIBLE STORING ID FROM SESSION*/
        $message->appendChild($userId);
        $dateTime = $xml->createAttribute('dateTime');
        $dateTime->value = date('Y-m-d H:i:s');
        $message->appendChild($dateTime);
        $root->appendChild($message);
        $existingMsg->appendChild($message);
        $xml->save('xml/tickets.xml');
    }
    public function closeTicket() {
        $xml = new DOMDocument;
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput = true;
        $xml->load('xml/tickets.xml');
        $root = $xml->getElementsByTagName('ticket')->item($_SESSION['ticketId'] - 1);
        $status = $root->setAttribute('status', 'Resolved');
        $xml->save('xml/tickets.xml');
    }
}
 ?>
