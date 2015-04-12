<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job extends MY_Controller {

    public function index() {
        $jobtitle  = $this->uri->segment(2);
        $jobnumber = $this->uri->segment(3);

        $job = null;
        if($jobtitle && $jobnumber) {
            $query = $this->db->get_where('job',array('job_number'=>$jobnumber));
            $job = $query->row();
            $view_params['job'] = $job;
        }

        //check data existence
        if ($job == NULL){
            show_404();
        }

        // pagination
        if($this->isPhone()) {
            if($pagination_params = $this->_get_pagination_params()) {
                $view_params = array_merge($view_params, $pagination_params);
            }
        }

        $view_params['source'] = $this->getSource();

        // breadcrumb link
        $view_params['list_title'] = get_cookie(COOKIE_LIST_TITLE);
        $view_params['list_url'] = get_cookie(COOKIE_LIST_URL);

        // share data
        $share_url = urlencode($job->short_url);
        $view_params['share_url'] = $share_url;
        $view_params['share_title'] = $job->job_title;
        $view_params['share_body'] = "{$job->job_title} ({$job->primary_work_location_city}, {$job->primary_work_location_country})";
        $view_params['share_mail_body'] = <<<EOF
{$job->job_title}%0D%0A
{$job->primary_work_location_city}, {$job->primary_work_location_country}%0D%0A
$share_url%0D%0A
EOF;

        if($job->delete_flg == 1) {
            $this->output->set_status_header('404');

            $head_params = array(
                'title' => "Error - expired job | RGF HR Agent Singapore",
                'description' => "",
                'keywords' => 'jobs singapore, recruitment agency, executive search, RGF, RGF Singapore, RGF HR Agent Singapore',
            );
            $header_mb_params = array(
                'searchbox' => false,
                'searchbox_value' => '',
                'searchbox_button' => false
            );
            if($this->isPhone()){
                $tpl["head"] = $this->load->view('common/head_mb', $head_params, true);
                $tpl["header"] = $this->load->view('common/header_mb', $header_mb_params, true);
                $tpl["contents"] = $this->load->view('job/expired_mb', $view_params, true);
                $tpl["footer"] = $this->load->view('common/footer_mb', null, true);
            } else {
                $tpl["head"] = $this->load->view('common/head', $head_params, true);
                $tpl["header"] = $this->load->view('common/header', array('arrow' => 'jobs'), true);
                $tpl["contents"] = $this->load->view('job/expired', $view_params, true);
                $tpl["footer"] = $this->load->view('common/footer', null, true);
            }

        } else {
            $head_params = array(
                'title' => "{$job->job_title} Jobs | RGF HR Agent Singapore",
                'description' => "{$job->job_title} job at RGF Singapore.",
                'keywords' => 'jobs singapore, recruitment agency, executive search, RGF, RGF Singapore, RGF HR Agent Singapore',
            );
            $header_mb_params = array(
                'searchbox' => true,
                'searchbox_value' => '',
                'searchbox_button' => true
            );
            $this->_set_recent_view($jobnumber);
            $this->_set_similar_currentjob($jobnumber);

            // insert view history for view_count
            $current_date = mdate("%Y-%m-%d %H:%i:%s", time());
            $this->db->set('job_number', $job->job_number);
            $this->db->set('view_date', $current_date);
            $this->db->insert('tmp_job_view');

            if($this->isPhone()){

                $tpl["head"] = $this->load->view('common/head_mb', $head_params, true);
                $tpl["header"] = $this->load->view('common/header_mb', $header_mb_params, true);
                $tpl["contents"] = $this->load->view('job/index_mb', $view_params, true);
                $tpl["footer"] = null;

            }else{
                $tpl["head"] = $this->load->view('common/head', $head_params, true);
                $tpl["header"] = $this->load->view('common/header', array('arrow' => 'jobs'), true);
                $tpl["contents"] = $this->load->view('job/index', $view_params, true);
                $tpl["footer"] = $this->load->view('common/footer', null, true);

            }
        }

        $this->load->view('common/layout', $tpl);
    }

    public function share() {
        $jobtitle  = $this->uri->segment(2);
        $jobnumber = $this->uri->segment(3);

        $job = null;
        if($jobtitle && $jobnumber) {
            $query = $this->db->get_where('job',array('job_number'=>$jobnumber));
            $job = $query->row();
            $view_params['job'] = $job;
        }

        //check data existence
        if ($job == NULL){
            show_404();
        }

        // share data
        $share_url = urlencode($job->short_url);
        $view_params['share_url'] = $share_url;
        $view_params['share_title'] = $job->job_title;
        $view_params['share_body'] = "{$job->job_title} ({$job->primary_work_location_city}, {$job->primary_work_location_country})";
        $view_params['share_mail_body'] = <<<EOF
{$job->job_title}%0D%0A
{$job->primary_work_location_city}, {$job->primary_work_location_country}%0D%0A
$share_url%0D%0A
EOF;
        $head_params = array(
            'title' => 'Share Job | RGF HR Agent Singapore',
            'description' => '',
            'keywords' => 'jobs singapore, recruitment agency, executive search, RGF, RGF Singapore, RGF HR Agent Singapore',
        );
        $header_mb_params = array(
            'searchbox' => false,
            'searchbox_value' => '',
            'searchbox_button' => false
        );
        if($job->delete_flg == 1) {
            $this->output->set_status_header('404');
            $tpl["head"] = $this->load->view('common/head_mb', $head_params, true);
            $tpl["header"] = $this->load->view('common/header_mb', $header_mb_params, true);
            $tpl["contents"] = $this->load->view('job/expired_mb', $view_params, true);
            $tpl["footer"] = $this->load->view('common/footer_mb', null, true);
        } else {
            $tpl["head"] = $this->load->view('common/head_mb', $head_params, true);
            $tpl["header"] = $this->load->view('common/header_mb', $header_mb_params, true);
            $tpl["contents"] = $this->load->view('job/share_mb', $view_params, true);
            $tpl["footer"] = $this->load->view('common/footer_mb2', null, true);
        }
        $this->load->view('common/layout', $tpl);
    }

    // set cookie 'recent_view'.
    private function _set_recent_view($new_jobid) {
        $cookie = get_cookie(COOKIE_RECENTLY_VIEW_JOB);


        // already exists.
        if ($cookie && strstr($cookie, $new_jobid.COOKIE_COMMON_SEPARATOR)) {
            // erase jobid
            $cookie = str_replace($new_jobid.COOKIE_COMMON_SEPARATOR, '', $cookie);
        }

        // to array
        $jobs = array();
        if ($cookie) {
            $jobs = str_getcsv($cookie, COOKIE_COMMON_SEPARATOR);
        }

        // set to head.
        array_unshift($jobs, $new_jobid);

        // max limitation.
        array_splice($jobs, COOKIE_RECENT_VIEW_LIMIT);


        // to string
        if ($jobs) {
            $cookie = '';
            foreach($jobs as $k => $v) {
                if ($v) {
                    $cookie .= ($v . COOKIE_COMMON_SEPARATOR);
                }
            }
        }


        // set cookie
        if ($cookie === "" || $cookie) {
            set_cookie(COOKIE_RECENTLY_VIEW_JOB, $cookie, COOKIE_EXPIRES);
        }
    }

    // set cookie 'similar_currentjob'.
    // Added on 27/5/14 for new change.
	private function _set_similar_currentjob($new_jobid) {
		$cookie = "";

		// already exists.
		if ($cookie) {
			// erase jobid
			$cookie = str_replace($new_jobid.COOKIE_COMMON_SEPARATOR, '', $cookie);
		}

		// to array
		$jobs = array();
		if ($cookie) {
			$jobs = str_getcsv($cookie, COOKIE_COMMON_SEPARATOR);
		}

		// set to head.
		array_unshift($jobs, $new_jobid);

		// max limitation.
        array_splice($jobs, COOKIE_SIMILAR_JOB_LIMIT);

		// 27/05/14 - Added for configuration of similar jobs.
		// Step 1. Get the required fields to be queried from the current job order.
		$query_result = $this->db->select('primary_work_location_country, job_category_1, job_category_2, min_month_salary, max_month_salary, recommend_min_month_salary, recommend_max_month_salary')->where('delete_flg', 0)->where('avature_job_id <>','null')->where('job_number',$new_jobid)->get('job')->result();

		// Step 2. Assign the field values to variables from the query result.
		foreach($query_result as $job) {
			$primary_work_location_country = $job->primary_work_location_country;
			$job_category_1 = $job->job_category_1;
			$job_category_2 = $job->job_category_2;
			$min_month_salary = $job->recommend_min_month_salary;
			$max_month_salary = $job->recommend_max_month_salary;
		}

		$this->db->select('job_number, job_title, job_category_1, job_category_2, primary_work_location_country, primary_work_location_city, min_month_salary, max_month_salary, currency');

		// Condition 1. [Pick out] Posted jobs from the same job category & search in Job Category 1 & 2
		$where_cond_1 = "delete_flg = 0 AND avature_job_id != 'null' AND (";

		if( !empty($job_category_1) ) {

			// If Job Cat 1 is not empty but Job Cat 2 is empty
			if( $job_category_1 != null ) {
				$where_cond_1 .= "(job_category_1 = '". $job_category_1 ."') OR (job_category_2 = '". $job_category_1 ."')";
			}

			// If Job Cat 1 is empty but Job Cat 2 is not empty
			if( $job_category_1 != null && $job_category_2 != null ) {
				$where_cond_1 .= " OR ";
			}

			if( $job_category_2 != null ) {
				$where_cond_1 .= "(job_category_1 = '". $job_category_2 ."') OR (job_category_2 = '". $job_category_2 ."')";
			}
			$where_cond_1 .= ")";
		}

		$this->db->where($where_cond_1);

		// Condition 2. [Filter by] Jobs with min. AND/OR max. salary falling within the same salary range
		$where_cond_2 = "( ( recommend_min_month_salary >= ". $min_month_salary ." AND recommend_min_month_salary <= ". $max_month_salary ." ) ";

		$where_cond_2 .= " OR ";

		$where_cond_2 .= " ( recommend_max_month_salary >= ". $min_month_salary ." AND recommend_max_month_salary <= ". $max_month_salary ." ) )";

		$this->db->where($where_cond_2);

		// Condition 3. [Pick out] Same primary work location, country
		$where_cond_3 = "primary_work_location_country = '". $primary_work_location_country ."'";

		$this->db->where($where_cond_3);

		// Step 3. Query based on the above result & fetch the similar jobs matching the criterion.
		$this->db->order_by('post_date DESC');

		$similarjobs_result= $this->db->get("job")->result();

		foreach($similarjobs_result as $similarjob) {
			$similarjoblist = $similarjob->job_number;
			$cookie .= ($similarjoblist . COOKIE_COMMON_SEPARATOR);
		}
		//echo $cookie;

		//print_r($this->db->last_query()."<br/>");

		//echo "Current Viewing Job: ".$new_jobid."<br/>";
		//echo "Current Job Details:"."<br/>";
		//echo "Primary Work Location Country: ".$primary_work_location_country."<br/>";
		//echo "Job Category 1: ".$job_category_1."<br/>";
		//echo "Job Category 2: ".$job_category_2."<br/>";
		//echo "Min Monthly Salary: ".$min_month_salary."<br/>";
		//echo "Max Monthly Salary: ".$max_month_salary."<br/>";
		//echo "Total Count: ".count($similarjobs_result)."<br/>";
		//echo "Cookie Value: ".$cookie."<br/><br/>";
		//echo "Modified Cookie Value".str_replace($cookie, $new_jobid, "");
		//$replace_cookie = substr_replace($cookie, '', 0) . "<br />\n";

		$cookie = str_replace($new_jobid,"",$cookie);

		// set cookie
		if ($cookie === "" || $cookie) {
			set_cookie(COOKIE_SIMILAR_JOB, $cookie, COOKIE_EXPIRES);
        }
    }

    private function _get_pagination_params() {
        # set prev and next links.
        $list_offset = get_cookie(COOKIE_LIST_OFFSET);
        $list_total_count = get_cookie(COOKIE_LIST_TOTAL_COUNT);
        $list_mode = get_cookie(COOKIE_LIST_MODE);

        if (!isset($list_offset) || !isset($list_total_count) || !isset($list_mode)) {
            return null;
        }

        $list_offset = intval($list_offset);
        $list_total_count = intval($list_total_count);

        $prev = $list_offset > 0;
        $next = $list_offset < $list_total_count;

        if(!$prev && !$next) {
            return null;
        }

        // set limit and offset;
        if($prev && $next) {
            $offset = $list_offset - 1;
            $limit = 3;
        } else if($prev && !$next) {
            $offset = $list_offset - 1;
            $limit = 1;
        } else {
            $offset = $list_offset + 1;
            $limit = 1;
        }

        $this->db->select('job_number, job_title');

        if($list_mode == LIST_MODE_SEARCH) {
            $words = get_cookie(COOKIE_LIST_WORDS);

            $this->_set_db_where_text_search($words);
        }

        $this->db->where('delete_flg', 0)->limit($limit, $offset);

        if($list_mode == LIST_MODE_FEATUREDJOBS) {
            $this->db->order_by('view_count DESC');
        }
        $this->db->order_by('post_date DESC, job_number DESC');
        $jobs = $this->db->get('job')->result();

        $pagination_params = array();
        if($prev) {
            $prev_job = current($jobs);
            $prev_job->offset = $list_offset - 1;
            $pagination_params += array('prev' => $prev_job);
        }
        if($next) {
            $next_job = end($jobs);
            $next_job->offset = $list_offset + 1;
            $pagination_params += array('next' => $next_job);
        }
        $pagination_params += array('total_page' => $list_total_count);
        $pagination_params += array('current_page' => $list_offset + 1);

        return $pagination_params;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/job.php */
