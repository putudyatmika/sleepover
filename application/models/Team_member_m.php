<?php

class Team_member_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_team_members()
    {
        $query = $this->db->query('call get_all_team_members()');
        $data = array();

        foreach (@$query->result() as $row)
        {
            $data[] = $row;
        }
        if(count($data))
            return $data;
        return false;
    }

    function modify($team_member)
    {
        //todo move this to a stored procedure
        if($team_member->team_id == null)
        {
            // we don't have a podestrian id, we're adding
            $this->db->insert('team_member', $team_member);
            return $this->db->affected_rows();
        }

        $this->db->where('team_id', $team_member->team_id);
        $this->db->update('team_member', $team_member);
    }

    function getTeamMember($team_id)
    {
        $query = $this->db->get_where('team_member', array('team_id' => $team_id));
        return $query->result();
    }

    function getRoles()
    {
        $query = $this->db->from('team_member_role')->get();
        $data = array();

        foreach ($query->result() as $row)
        {
            $data[] = $row;
        }
        if(count($data))
            return $data;
        return false;
    }
}
