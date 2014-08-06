<?php

namespace Nipponjob\AccueilBundle\Entity;

class Contact
{

    private $id;
    private $mail;
    private $message;

    public function getId()
    {
        return $this->id;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
