<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     //category has childs
    public function childs() {
        return $this->hasMany('App\Category','parent_id','id') ;
    }

	function categories_dropdown()
    {
       $query = $this->db->order_by("name","ASC")->get('categories');

        if($query->num_rows()>0)
        {
            $result = $query->result();
			foreach($result as $k=>$row){
				$result[$k]->full_name = substr_replace($this->get_parent_name($row->id),"", -3);

			}

			usort($result, array("App\Category", "cmp"));
			return $result;
        }
        else
        {
            return null;
        }
    }


	function cmp($a, $b){
		return strcmp($a->full_name, $b->full_name);
	}

	public function get_parent_name($id=0) {
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('id', $id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $this->get_parent_name($query->row()->parent_id).$query->row()->name . ' > ';
		}
		else {
			return false;
		}
	}
}
