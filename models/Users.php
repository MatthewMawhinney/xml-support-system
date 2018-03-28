<?php

class User {

    public function userAddTicket($catInput, $msgInput) {
        $doc = new DOMDocument;
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->load('xml/tickets.xml');
        //get root tickets element
        $root = $doc->getElementsByTagName('tickets')->item(0);
        //creating id auto incrementer
        $ticketIdNum = $root->childNodes->length + 1;
        //create new ticket from form data
        $ticket = $doc->createElement('ticket'); //create <item> element
        $ticketId = $doc->createAttribute('id');
        $ticketId->value = $ticketIdNum;
        $ticket->appendChild($ticketId);
        $ticketDate = $doc->createAttribute('date');
        $ticketDate->value = date('Y-m-d');
        $ticket->appendChild($ticketDate);
        $ticketStatus = $doc->createAttribute('status');
        $ticketStatus->value = "Open";
        $ticket->appendChild($ticketStatus);
        $category = $doc->createElement('category', $catInput); //value from dropdown
        $clientId = $doc->createElement('clientId', $_SESSION['userId'] /*VARIABLE STORING ID FROM SESSION */);
        $messages = $doc->createElement('messages');
        $supportMsg = $doc->createElement('supportMsg', $msgInput);
        $userId = $doc->createAttribute('userId');
        $userId->value = $_SESSION['userId']; //*VARAIBLE STORING ID FROM SESSION*/
        $supportMsg->appendChild($userId);
        $dateTime = $doc->createAttribute('dateTime');
        $dateTime->value = date('Y-m-d H:i:s');
        $supportMsg->appendChild($dateTime);
        $messages->appendChild($supportMsg);
        $ticket->appendChild($category);
        $ticket->appendChild($clientId);
        $ticket->appendChild($messages);
        //add item to tickets
        $root->appendChild($ticket);
        $doc->save('xml/tickets.xml');
    }
    public function loginUser($userInput, $passInput) {
        //Check if username and password match a users.xml item
        $xml = simplexml_load_file('xml/users.xml');
        foreach ($xml->children() as $user) {
          if ($user->username == $userInput && $user->password == $passInput) {
              $_SESSION['loggedIn'] = true;
              $_SESSION['userId'] = (string)$user['id']; //USER ID for logged in user
              $_SESSION['userName'] = (string)$user->name->first; //USER FIRST NAME
              $_SESSION['role'] = (string)$user['role']; //client/support
          }
        }
    }
}
 ?>
