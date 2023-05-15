<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Model extends CI_Model{

	//-------------------------------------------------------------------
    // contant us 
	public function contact($data)
	{
		$this->db->insert('xx_contact_us',$data);
		return true;
	}

	//-------------------------------------------------------------------
	// Get jobs for home page
	public function get_jobs($limit, $offset)
	{
		$this->db->select('id, title, company_id, job_slug, job_type, description, country, city, created_date, industry');
		$this->db->from('xx_job_post');
		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;

		return $query->result_array();
	}

	//----------------------------------------------------
	// Get those citites who have jobs
	public function get_cities_with_jobs()
	{
		$this->db->select('city as name, COUNT(city) as total_jobs');
		$this->db->from('xx_job_post');
		$this->db->group_by('city');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Get companies logos having active job for home page
	public function get_companies_having_active_jobs($limit)
	{
		$this->db->select('
			xx_job_post.company_id, 
			xx_job_post.is_status, 
			xx_companies.company_slug, 
			xx_companies.company_logo,
		');
		$this->db->join('xx_job_post','xx_job_post.company_id = xx_companies.id');
		$this->db->where('xx_job_post.is_status','active');
		$this->db->limit($limit);
		$this->db->group_by('xx_companies.company_slug');
		$this->db->from('xx_companies');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_latest_blog_post()
	{
		$this->db->select('xx_blog_posts.*');
		$this->db->from('xx_blog_posts');
		$this->db->order_by('created_at','desc');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result_array();
	}

	//get page
    public function get_page($slug)
    {
        $this->db->where('slug', $slug);
        $this->db->where('is_active', 1);
        $query = $this->db->get('xx_pages');
        return $query->row_array();
    }

    //-------------------------------------------------------------------
	// Get testimonials
	public function get_testimonials()
	{
		$this->db->select('*');
		$this->db->from('xx_testimonials');
		$this->db->order_by('is_default','desc');
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result_array();

	}

	public function add_subscriber($data)
	{
		$this->db->where('email',$data['email']);
		$query = $this->db->get('xx_subscribers');

		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			$this->db->insert('xx_subscribers',$data);
			return true;
		}
	}

}

?>