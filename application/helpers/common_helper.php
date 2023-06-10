<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// -----------------------------------------------------------------------------
    // Get General Setting
    if (!function_exists('get_general_settings')) {
        function get_general_settings()
        {
            $ci =& get_instance();
            $ci->load->model('admin/setting_model');
            return $ci->setting_model->get_general_settings();
        }
    }

    // -----------------------------------------------------------------------------
    //get recaptcha
    if (!function_exists('generate_recaptcha')) {
        function generate_recaptcha()
        {
            $ci =& get_instance();
            if ($ci->recaptcha_status) {
                $ci->load->library('recaptcha');
                echo '<div class="form-group mt-2">';
                echo $ci->recaptcha->getWidget();
                echo $ci->recaptcha->getScriptTag();
                echo ' </div>';
            }
        }
    }

    // -----------------------------------------------------------------------------
    // Footer Settings
    if (!function_exists('get_footer_settings')) {
        function get_footer_settings()
        {
            $ci =& get_instance();
            $ci->db->select('*');
            return $ci->db->get('xx_footer_settings')->result_array();
        }
    }

    // ----------------------------------------------------------------------------
     //print old form data
    if (!function_exists('old')) {
        function old($field)
        {
            $ci =& get_instance();
            return html_escape($ci->session->flashdata('form_data')[$field]);
        }
    }

    // ------------------------------------------------------
    // get languages
    function get_site_languages()
    {
        $ci = & get_instance();
        return $ci->db->get('xx_site_languages')->result_array();
    }

    // ------------------------------
    // Get currency symbol by ID
    function get_currency_symbol($id)
    {
        $ci = & get_instance();
        $ci->db->select('symbol');
        $ci->db->where('id',$id);
        return $ci->db->get('xx_currency')->row_array()['symbol'];
    }

    // ------------------------------
    // Get currency symbol by ID
    function get_currency_short_code($id)
    {
        $ci = & get_instance();
        $ci->db->select('code');
        $ci->db->where('id',$id);
        return $ci->db->get('xx_currency')->row_array()['code'];
    }


    // ----------------------------------------------------------------------------
     // get User id
    function user_id()
    {
        $ci = & get_instance();
        return $ci->session->userdata('user_id');
    }

    // ----------------------------------------------------------------------------
    // get Employer id
    function emp_id()
    {
        $ci = & get_instance();
        return $ci->session->userdata('employer_id');
    }

     // -----------------------------------------------------------------------------
    // get user profile by ID
    function get_user_profile($id)
    {
         $ci = & get_instance();
        return $ci->db->select('profile_picture')
        ->where('id',$id)
        ->get('xx_users')
        ->row_array()['profile_picture'];
    }

    // -----------------------------------------------------------------------------
    // get user profile by ID
    function get_employer_profile($id)
    {
         $ci = & get_instance();
        return $ci->db->select('profile_picture')
        ->where('id',$id)
        ->get('xx_employers')
        ->row_array()['profile_picture'];
    }

    // ----------------------------------------------------------------------------
    //get all pages
    function get_all_pages()
    {
        $ci = & get_instance();
        $ci->db->order_by('sort_order');
        $query = $ci->db->get('xx_pages');
        return $query->result_array();
    }

    // ----------------------------------------------------------------------------
    // get employer detail by id
    function get_emp_by_id($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_employers', array('id' => $id))->row_array();
    }

    //------------------------------------------------  
    // Get Active Package
    function get_emp_pkg_detail()
    {
        $ci = & get_instance();
        $query = $ci->db->get_where('xx_packages_bought', array('employer_id' => emp_id(), 'is_active' => 1));
        return $result = $query->row_array()['id'];
    }

    // -----------------------------------------------------------------------------
    // Get Package Days
    function get_package_days($pkg_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_packages', array('id' => $pkg_id))->row_array()['no_of_days'];
    }

    // -----------------------------------------------------------------------------
    // Get Package Name
    function get_pkg_name($pkg_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_packages', array('id' => $pkg_id))->row_array()['title'];
    }

    // ------------------------------------------------------
    // get languages

    function get_languages_list()
    {
        $ci = & get_instance();
        return $ci->db->get('xx_languages')->result_array();
    }

    function get_language_levels()
    {
        return array(
        '' => trans('select_option'),
        '1' => 'Beginner',
        '2' => 'Intermediate',
        '3' => 'Expert',
      );
    }

    function get_experience_list($type)
    {
        $experience = [];
        $experience[''] = $type;
        for ($i= 1; $i < 21 ; $i++) { 
            $experience[$i] = $i.' Years';
        }
        return $experience;
    }

    function get_language_name($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_languages', array('lang_id' => $id))->row_array()['lang_name'];
    }

    function get_lang_proficiency_name($id)
    {
        if($id == '1')
            return 'Beginner';
        if($id == '2')
            return 'Intermediate';
        if($id == '3')
            return 'Expert';
    }

    function get_months_list()
    {
        return array(
        '' => 'Month',
        '1' => 'Jan',
        '2' => 'Feb',
        '3' => 'Mar',
        '4' => 'Apr',
        '5' => 'May',
        '6' => 'Jun',
        '7' => 'Jul',
        '8' => 'Aug',
        '9' => 'Sep',
        '10' => 'Oct',
        '11' => 'Nov',
        '12' => 'Dec',
      );
    }

    function get_years_list()
    {
        $years = [];
        $years[''] = 'Year';
        for ($i=0; $i < 50; $i++) { 
            $year = date('Y',strtotime('- '.$i.' years'));
            $years[$year] = $year;
        }
        return $years;
    }

    function get_nth_month($nth)
    {
        return date('M',strtotime($nth.' month'));
    }

   

    // -----------------------------------------------------------------------------
    // Get industry name by id
    function get_industry_name($id)
    {
    	$ci = & get_instance();
    	return $ci->db->get_where('xx_industries', array('id' => $id))->row_array()['name'];
    }

    // -----------------------------------------------------------------------------
    // Get category name by id
    function get_category_name($id)
    {
    	$ci = & get_instance();
    	return $ci->db->get_where('xx_categories', array('id' => $id))->row_array()['name'];
    }

    // -----------------------------------------------------------------------------
    // Get category ID by title
    function get_category_id($category_name)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_categories', array('slug' => $category_name))->row_array()['id'];
    }

    // -----------------------------------------------------------------------------
    // Get employment type
    function get_employment_type_list()
    {
        $ci = & get_instance();
        return $ci->db->get('xx_employment')->result_array();
    }

    // -----------------------------------------------------------------------------
    // Get country list
    function get_country_list()
    {
        $ci = & get_instance();
        return $ci->db->get('xx_countries')->result_array();
    }

    // -----------------------------------------------------------------------------
    // Get country name by ID
    function get_country_name($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_countries', array('id' => $id))->row_array()['name'];
    }

    // -----------------------------------------------------------------------------
    // Get City ID by Name
    function get_country_id($title)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_countries', array('slug' => $title))->row_array()['id'];
    }

    // -----------------------------------------------------------------------------
    // Get country slug
    function get_country_slug($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_countries', array('id' => $id))->row_array()['slug'];
    }

    // -----------------------------------------------------------------------------
    // Get country's states
    function get_country_states($country_id)
    {
        $ci = & get_instance();
        return $ci->db->select('*')->where('country_id',$country_id)->get('xx_states')->result_array();
    }

    // -----------------------------------------------------------------------------
    // Get state's cities
    function get_state_cities($state_id)
    {
        $ci = & get_instance();
        return $ci->db->select('*')->where('state_id',$state_id)->get('xx_cities')->result_array();
    }

    // Get state name by ID
    function get_state_name($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_states', array('id' => $id))->row_array()['name'];
    }

    // -----------------------------------------------------------------------------
    // Get city name by ID
    function get_city_name($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_cities', array('id' => $id))->row_array()['name'];
    }

    // -----------------------------------------------------------------------------
    // Get city ID by title
    function get_city_slug($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_cities', array('id' => $id))->row_array()['slug'];
    }


    // -----------------------------------------------------------------------------
    // Get category by ID
    function get_category_slug($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_categories', array('id' => $id))->row_array()['slug'];
    }

    // -----------------------------------------------------------------------------
    // Get industry by title
    function get_industry_id($title)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_industries', array('slug' => $title))->row_array()['id'];
    }

    // -----------------------------------------------------------------------------
    // Get industry by id
    function get_industry_slug($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_industries', array('id' => $id))->row_array()['slug'];
    }

    // -----------------------------------------------------------------------------
    // Get City ID by Name
    function get_city_id($title)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_cities', array('slug' => $title))->row_array()['id'];
    }

    // -----------------------------------------------------------------------------
    // Get Nationality by ID
    function get_nationality_name($id)
    {
    	$ci = & get_instance();
    	return $ci->db->get_where('xx_countries', array('id' => $id))->row_array()['country'];
    }

    // -----------------------------------------------------------------------------
    // Get Education list
    function get_education_list()
    {
        $ci = & get_instance();
        return $ci->db->get('xx_education')->result_array();
    }

    // -----------------------------------------------------------------------------
    // Get job type list
    function get_job_type_list()
    {
        $ci = & get_instance();
        return $ci->db->get('xx_job_type')->result_array();
    }
    
    // -----------------------------------------------------------------------------
    // Get job detail
    function get_job_detail($id)
    {
        $ci = & get_instance();
        $ci->db->select('title,job_slug');
        $ci->db->where('id',$id);
        return $ci->db->get('xx_job_post')->row_array();
    }

    // -----------------------------------------------------------------------------
    // Get job type list
    function get_job_type_name($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_job_type',array('id' => $id))->row_array()['type'];
    }

    // -----------------------------------------------------------------------------
    // Get Nationality by ID
    function get_education_level($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_education', array('id' => $id))->row_array()['type'];
    }

    // -----------------------------------------------------------------------------
    // Get User Skills
    function get_user_skills($user_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_users', array('id' => $user_id))->row_array()['skills'];
    }
    
    // -----------------------------------------------------------------------------
    // Get User Email
    function get_user_email($user_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_users', array('id' => $user_id))->row_array()['email'];
    }

    // -----------------------------------------------------------------------------
    // Get Company Name by Employer ID
    function get_company_name_by_employer($emp_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_companies', array('employer_id' => $emp_id))->row_array()['company_name'];
    }

    // -----------------------------------------------------------------------------
    // Get Company Name by Employer ID
    function get_company_id_by_employer($emp_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_companies', array('employer_id' => $emp_id))->row_array()['id'];
    }

    // -----------------------------------------------------------------------------
    // Get Company ID by title
    function get_company_id($title)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_companies', array('company_slug' => $title))->row_array()['id'];
    }

     // -----------------------------------------------------------------------------
    // Get Company Name by id
    function get_company_name($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_companies', array('id' => $id))->row_array()['company_name'];
    }

    //  get blog categories
    function get_blog_categories_list()
    {
        $ci = & get_instance();
        return $ci->db->get('xx_blog_categories')->result_array();
    }

    //  get blog posted categories
    function get_blog_posted_categories_list()
    {
        $ci = & get_instance();
        $ci->db->select('
            xx_blog_posts.category_id,
            xx_blog_categories.id,
            xx_blog_categories.slug,
            xx_blog_categories.name
            ');
        $ci->db->join('xx_blog_posts','xx_blog_posts.category_id = xx_blog_categories.id');
        $ci->db->group_by('xx_blog_posts.category_id');
        return $ci->db->get('xx_blog_categories')->result_array();
    }

    // -----------------------------------------------------------------------------
    function get_blog_categories_name($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('xx_blog_categories', array('id' => $id))->row_array()['name'];
    }

    // -----------------------------------------------------------------------------
    function get_post_tags_by_id($post_id)
    {
        $ci = & get_instance();
        return $ci->db->select('*')
        ->where(array('post_id' => $post_id))
        ->get('xx_blog_tags')
        ->result_array();
    }

    // -----------------------------------------------------------------------------
    function get_tags_list()
    {
        $ci = & get_instance();
        return $ci->db->select('*')
        ->group_by('tag')
        ->get('xx_blog_tags')
        ->result_array();
    }

    // -----------------------------------------------------------------------------
    function get_recent_blog_post()
    {
        $ci = & get_instance();
        return $ci->db->select('*')
        ->order_by('created_at','desc')
        ->limit(4)
        ->get('xx_blog_posts')
        ->result_array();
    }

    // -----------------------------------------------------------------------------
    function get_next_post($current_post_id)
    {
        $ci = & get_instance();
        return $ci->db->select('*')
        ->where('id >',$current_post_id)
        ->limit(1)
        ->get('xx_blog_posts')
        ->row_array();
    }

    // -----------------------------------------------------------------------------
    function get_previous_post($current_post_id)
    {
         $ci = & get_instance();
        return $ci->db->select('*')
        ->where('id <',$current_post_id)
        ->limit(1)
        ->get('xx_blog_posts')
        ->row_array();
    }

/**
 * Generic function which returns the translation of input label in currently loaded language of user
 * @param $string
 * @return mixed
 */
function trans($string)
{
    $ci =& get_instance();
    return $ci->lang->line($string);
}

?>