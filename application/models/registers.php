<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registers
 *
 * @author Borey
 */
class registers extends CI_Model {

    //This function for insert data to database
    function save($person, $password) {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password'))
        );
        $this->db->insert('phppos_employees', $data);
    }

    public function add_user($person, $password) {
//        $this->db->insert('people', $person);
//        $id_user = $this->db->insert_id();
//
//        $sql2 = "INSERT INTO phppos_employees(person_id, username, password) 
//            VALUES ($id_user, ?, ?)";
//        $this->db->query($sql2, $password);
//
//        $this->db->trans_complete();
//        return $this->db->insert_id();
        
    }

}
