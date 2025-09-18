<?php

require_once '../settings/db_class.php';

/**
 * 
 */
class User extends db_connection
{
    private $user_id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $date_created;
    private $country;
    private $phone_number;
    private $city;

    public function __construct($user_id = null)
    {
        parent::db_connect();
        if ($user_id) {
            $this->user_id = $user_id;
            $this->loadUser();
        }
    }

    private function loadUser($user_id = null)
    {
        if ($user_id) {
            $this->user_id = $user_id;
        }
        if (!$this->user_id) {
            return false;
        }
        $stmt = $this->db->prepare("SELECT * FROM customer WHERE customer_id = ?");
        $stmt->bind_param("i", $this->user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if ($result) {
            $this->name = $result['customer_name'];
            $this->email = $result['customer_email'];
            $this->role = $result['user_role'];
            $this->date_created = isset($result['date_created']) ? $result['date_created'] : null;
            $this->phone_number = $result['customer_contact'];
            $this->country      = $result['customer_country'];
            $this->city         = $result['customer_city'];
        }
    }

    public function createUser($name, $email, $password_hash, $phone_number, $role, $country, $city)
    {
        $stmt = $this->db->prepare("INSERT INTO customer (customer_name, customer_email, customer_pass, customer_contact, user_role, customer_country, customer_city) VALUES (?, ?, ?, ?, ?,?,?)");
        $stmt->bind_param("ssssi", $name, $email, $password_hash, $phone_number, $role, $country, $city);
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        return false;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM customer WHERE customer_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

}
