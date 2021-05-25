<?php

class Contact
{
    // Attributs d'un contact
    public $id;
    public $last_name;
    public $first_name;
    public $email;
    public $address;
    public $phone;
    public $age;

    public function hydrate($datas)
    {
        foreach($datas as $key => $value) {
            if (property_exists('Contact', $key)) {
                $this->$key = $value;
            }
        }
    }
}

?>