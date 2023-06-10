<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
    
    //---------------------------------------------------------------------
    // Pagination Association function
    function pagination_assoc($varkey, $assoc_n)
    {
        $ci =& get_instance();
        
        $qs_arr = $ci->uri->uri_to_assoc($assoc_n);
        $qs_tmp_arr = array();

        foreach ($qs_arr as $key => $value) {
            if ($key != $varkey) {
                $qs_tmp_arr[$key] = $value;
                $assoc_n = 0;
            }
        }

        foreach ($ci->uri->segment_array() as $key => $value) {
            if ($value == 'p') {
                $assoc_n = $key;
            }
        }

        $offset = (isset($qs_arr [$varkey]))? $qs_arr[$varkey]: 0;

        $qs_uri = $ci->uri->assoc_to_uri($qs_tmp_arr). '/'. $varkey;

        $arr = array(
            'offset' => $offset,
            'seg' => $assoc_n + 1,
            'uri' => $qs_uri
        );

        return $arr;

    }

    // -----------------------------------------------------------------------------
    function clean_url($string)
     {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $string); // Removes special chars.
        $string = preg_replace('/-+/', '-', $string); //
        return $result = strtolower($string);
     
     }    

     //----------------------------------------------------------------------------
    function year_dropdown($field_name, $earliest_year, $selected_value){
            
        $already_selected_value = $selected_value;
        $earliest_year = $earliest_year;

        print '<select class="form-control" name="'.$field_name.'">';
        foreach (range(date('Y'), $earliest_year) as $x) {
            print '<option value="'.$x.'"'.($x == $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
        }
        print '</select>';
     }

    // -----------------------------------------------------------------------------
    function time_ago($date) {
        if(empty($date)) {
            return trans('no_date');
        }
        $periods = array(trans('second'),trans('minute'), trans('hour'), trans('day'), trans('week'), trans('month'), trans('year'), trans('decade'));
        $lengths = array("60","60","24","7","4.35","12","10");
        $now = time();
        $unix_date = strtotime($date);
        // check validity of date
        if(empty($unix_date)) {
            return "";
        }
        // is it future date or past date
        if($now > $unix_date) {
            $difference = $now - $unix_date;
            $tense = trans('ago');
        } else {
            $difference = $unix_date - $now;
            $tense = trans('from_now');
        }
        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }
        $difference = round($difference);
        if($difference != 1) {
            $periods[$j].= "s";
        }

        return "$difference $periods[$j] {$tense}";
    }

    // --------------------------------------------------------------------------------
    function date_time($datetime) 
    {
       return date('F j, Y',strtotime($datetime));
    }

    // --------------------------------------------------------------------------------
    function add_days_to_date($days) 
    {
       return date('Y-m-d', strtotime(' + '.$days.' days'));
    }


    // --------------------------------------------------------------------------------
    // limit the no of characters
    function text_limit($x, $length)
    {
      if(strlen($x)<=$length)
      {
        return $x;
      }
      else
      {
        $y=substr($x,0,$length) . '...';
        return $y;
      }
    }

    // -----------------------------------------------------------------------------
    // Make Slug Function    
    if (!function_exists('make_slug'))
    {
        function make_slug($string)
        {
            $lower_case_string = strtolower($string);
            $string1 = preg_replace('/[^a-zA-Z0-9 ]/s', '', $lower_case_string);
            return strtolower(preg_replace('/\s+/', '-', $string1));        
        }
    }

    //-----------------------------------------------------------------------------
    function encode($input) 
    {
        return urlencode(base64_encode($input));
    }
    
    //-----------------------------------------------------------------------------
    function decode($input) 
    {
        return base64_decode(urldecode($input) );
    }

?>