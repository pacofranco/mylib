<?php

function coursebyuser ($theuser){ // function
global $DB;

$result = $DB->get_records_sql('SELECT u.firstname, u.lastname, c.id, c.fullname
                                FROM {course} AS c
                                JOIN {context} AS ctx ON c.id = ctx.instanceid
                                JOIN {role_assignments} AS ra ON ra.contextid = ctx.id
                                JOIN {user} AS u ON u.id = ra.userid
                                WHERE u.id = '.$theuser.'');
echo "<ul>";
foreach ($result as $thecourse) {
    echo "<li><a href='$CFG->wwwroot/course/view.php?id=".$thecourse->id."'> ".$thecourse->fullname;
    echo "</a>";
    if($thecourse->visible == 0){
        echo "<span style='color: #cecece; font-weight: bold;'> Curso no Accesible</span>";
    }
    
    echo "</li>";
    echo "</ul>";
    
}

} // function



// IP

        function ip_limit ($myip, $iplimited)
        {
            if ($myip == $iplimited){
                return TRUE;
            }
        }

        $ip = '127.0.0.1';
        if (ip_limit($USER->lastip,$ip )) {
            echo "HOlaaa";

        }
                
// IP
               
                
 function mytime($idUsuario, $idCourse) {    // function
		
	global $CFG;
	global $COURSE;
	$con = mysql_connect($CFG->dbhost, $CFG->dbuser, $CFG->dbpass);
	mysql_select_db($CFG->dbname);
		

	$db_pref = "mdl_";
		
	$q = "SELECT * FROM ".$db_pref."log 
	WHERE userid='".$idUsuario."' 
	AND (course='".$idCourse."' OR course='1')  
	ORDER BY time ASC";
	$a_debug ['q'] =$q;
	$res = mysql_query($q,$con);
	$entradacourse = 0;
	while($row = mysql_fetch_assoc($res)){  // 

	// comenzamos a contar a partir de que el alumno entra en el curso
		if($row['action']=='view' && $row['course']==$idCourse && $entradacourse==0)$entradacourse = 1;
		if($entradacourse == 1){ 
			$rows_log[] = array(
				'time'  => $row['time'],
				'action'=> $row['action']
			);
		}
		
	
	}  //	
	unset($row);
	mysql_free_result($res);
	
		foreach ($rows_log as $k => $v){
		if ($k == 0) continue; // para el primer registro continuamos
		$anterior = $k-1;
		$time     = $v['time'];
		$action   = $v['action'];
		// restamos el registro actual menos el anterior
		$dif = $time - $rows_log[$anterior]['time'];
		if($dif==0)$dif=0;
		// si el anterior registro es un logout no se cuenta nada
		if ($rows_log[$anterior]['action']=='logout'){
			 // para login y logout no contamos nada 
			 continue;
		// si el actual registro en un login se comprueba si ha excedido el tiempo maximo de conexión
		}elseif ($action == 'login') {
			 // para una diferencia de mas de mastimeconnect se cuenta 0
			 if ($dif > $maxtimeconnect) $dif = 0;  
		}
		$aux =  $totaltime;
		$totaltime = $aux + $dif;
	}
	return segundos_tiempo($totaltime);
	}        // function
	
	
	function segundos_tiempo($segundos){
	$minutos=$segundos/60;
	$horas=floor($minutos/60);
	$minutos2=$minutos%60;
	$segundos_2=$segundos%60%60%60;
	if($minutos2<10)$minutos2='0'.$minutos2;
	if($segundos_2<10)$segundos_2='0'.$segundos_2;
	
	if($segundos<60){ // segundos
		$resultado= '00:00:'.round($segundos);
	}elseif($segundos>60 && $segundos<3600){// minutos 
		$resultado= '00:'.$minutos2.':'.$segundos_2;
	}else{// horas 
		$resultado= $horas.':'.$minutos2.':'.$segundos_2;
	}
	return $resultado;
}
            

        mytime($USER->id,$COURSE->id);               
        
        
        
     // permisos
        
     function hasPermission($usuario, $idRol) {
     $permisos = array(
          'ver_informes' => array(1,2,4),
          'ver_secretaria' => array(1, 4),
  
    );
    }
    
    if (hasPermission($USER->id, 'ver_informes')){
    echo "Autorizado";
}


    // permisos


// summary


$context = context_course::instance($course->id);
$summary = file_rewrite_pluginfile_urls($course->summary, 'pluginfile.php', $context->id, 'course', 'summary', null);
$summary = format_text($summary, $course->summaryformat, $options, $course->id);
echo $summary;

// summary
        
        
// mod url

			$cs = get_coursemodules_in_course('certificate', $micurso->courseid );
			if ($cs) {
			foreach ($cs as $c) {
			$output .="<p><a href='".$CFG->wwwroot."/mod/certificate/view.php?id=".$c->id."'>";
			$output .= '<img src="'.$CFG->wwwroot.'/my/ext/fresa.png" width="25px"/>';
			$output .=$c->name."</a></p>";
			}
			} else {
			$output .="<p>El Certificado parece no estar disponible, en breve podras obtenerlo. Disculpa por favor, las molestias</p>";
			}


// mod ulr
        
        
// users
                          
                    
                        if ($users = get_users_by_capability($context, 'moodle/course:update', 'u.*', 'u.id ASC',
                          '', '', '', '', false, true)) {
                          $users = sort_by_roleassignment_authority($users, $context);
                          $teacher = array_shift($users);
                      }
                      
                      
                      $students = get_enrolled_users(get_context_instance(CONTEXT_COURSE, $course->id));
                      $students = get_enrolled_users(get_context_instance(CONTEXT_COURSE, $course->id), $withcapability = '', $groupid = 0, $userfields = 'u.*', $orderby = 'id', $limitfrom = 0, $limitnum = 10);
    
                      $user = $DB->get_record('user', array('id'=>$u));
                      
                      // users number
                      
                      count_enrolled_users(get_context_instance(CONTEXT_COURSE, $course->id), $withcapability = '', $groupid = 0);
                      
                      // For example you want to know who is able to summit assignment right now:
                      $submissioncandidates = get_enrolled_users($modcontext, 'mod/assignment:submit');                    
// users
                      
                 
//course activities
                            $act = get_array_of_activities($course->id);
                            foreach ($act as $acts) {
                             echo "<p>".$acts->name." ".$acts->mod."</p>";
                            }
                            
                            $act = get_array_of_activities($course->id);
                            foreach ($act as $acts) {
                            echo "<p><a href='".$CFG->wwwroot."/mod/".$acts->mod."/view.php?id=".$acts->cm."'>".$acts->name." ".$acts->mod.$acts->cm."</a></p>";
                            }h
                            
                            $my_modules = get_course_mods($COURSE->id);
                            
                            $cm = get_coursemodule_from_instance('scorm', $scorm->id);
                            
                            
                            
                          

//course activities 
        
        
                            
                            echo course_format_name ($course->id,$max=100);
                            
// left join                        
                            
                                $sql = "SELECT s.*
                                FROM {scorm} s
                                LEFT JOIN {scorm_scoes} c ON s.launch = c.id
                                WHERE c.id IS null OR s.id <> c.scorm";
                                $scorms = $DB->get_recordset_sql($sql)

// left join
                
                 if(is_siteadmin($user));
                                        
                                        
                                
                                      
                                      
                function get_theusers($mycourse){
                global $USER, $DB;

                         $user = $DB->get_records_sql(
                          "SELECT usr.firstname, usr.lastname, usr.email, c.fullname
                            FROM mdl_course c
                            INNER JOIN mdl_context cx ON c.id = cx.instanceid
                            AND cx.contextlevel = '50' and c.id='".$mycourse."'
                            INNER JOIN mdl_role_assignments ra ON cx.id = ra.contextid
                            INNER JOIN mdl_role r ON ra.roleid = r.id
                            INNER JOIN mdl_user usr ON ra.userid = usr.id
                            ORDER BY usr.firstname, c.fullname"
                            );

                         return $user;
            }        
            
            $users = get_theusers($course->id);
            echo "<ul>";
            foreach ($users as $u) {
                 echo "<li>".$u->firstname." ".$u->lastname." ".$u->email."</li>";
            }  
            echo "</ul>";
            
            
            
            
            
            function get_theusers($mycourse, $myrole){
            	global $USER, $DB;
            

            $userS = $DB->get_records_sql("SELECT usr.id, usr.firstname, usr.lastname, usr.email, c.fullname
							               FROM {course} c
							               INNER JOIN {context} cx ON c.id = cx.instanceid
							               AND cx.contextlevel = '50' and c.id='".$mycourse."'
							               INNER JOIN {role_assignments} ra ON cx.id = ra.contextid
							               INNER JOIN {role} r ON ra.roleid = r.id
							               INNER JOIN {user} usr ON ra.userid = usr.id
							               WHERE r.id = '".$myrole."'
							               ORDER BY usr.lastname, c.fullname"
							                );
				            
            	return $users;
            }
            
            
            if (user_has_role_assignment($myusers->id,5)) { 
            	echo 'Student'; 
            }
            
            
// courses by user
            
                $query_miscursos = 'SELECT
                c.id AS courseid, 
                c.fullname, 
                c.visible, 
                c.summary,
                c.summaryformat,
                DATE(FROM_UNIXTIME(c.startdate)) AS startdate,
                DATE(FROM_UNIXTIME(c.enddate)) AS enddate,
                u.username, 
                u.firstname, 
                u.lastname, 
                u.email

                FROM 
                mdl_role_assignments ra 
                JOIN mdl_user u ON u.id = ra.userid
                JOIN mdl_role r ON r.id = ra.roleid
                JOIN mdl_context cxt ON cxt.id = ra.contextid
                JOIN mdl_course c ON c.id = cxt.instanceid

                WHERE ra.userid = u.id

                AND ra.contextid = cxt.id
                AND cxt.contextlevel =50
                AND cxt.instanceid = c.id
                AND userid = ' . $user->id . '
                ORDER BY c.enddate DESC';
                
// courses by user
            
        public function get_v() {
		global $DB, $USER;
		$sql = "SELECT * FROM mdl_questionnaire_attempts AS mqa, mdl_questionnaire AS mq
                        WHERE mq.course = 5
                        AND mqa.userid = 641
                        AND mqa.qid = mq.id
                        "; 
				
		$rs = $DB->get_recordset_sql($sql);
		return $rs;	
		
                
	}
        
		$numcourses = $DB->count_records("course");
	
        $mycourses = enrol_get_all_users_courses($user->id, true, NULL, 'visible DESC,sortorder ASC');
        $mycourses = enrol_get_all_users_courses($USER->id, true, 'summary, summaryformat', 'visible DESC,sortorder ASC');
        
        $context  = get_context_instance(CONTEXT_COURSE, $course->id);
		$role = $DB->get_record('role', array('shortname' => 'student'));
		$users = get_role_users($role->id, $context);
		
		
		
                
        $DB->get_records('question_answers' array('question', $questionid), 'id ASC');
         
         
         

UPDATE mdl_user_enrolments
SET timeend = UNIX_TIMESTAMP('2013-12-31 23:59:59')
WHERE enrolid = 5555;

            $mode = optional_param('mode', 'posts', PARAM_ALPHA);   // The mode to use. Either posts or discussions
            
            $discussionsonly = ($mode !== 'posts');
            $isspecificcourse = !is_null($courseid);
            $iscurrentuser = ($USER->id == $userid);


            // Now we need to get all of the courses to search.
            // All courses where the user has posted within a forum will be returned.
            $courses = forum_get_courses_user_posted_in($user, $discussionsonly);
            
            // Get the posts by the requested user that the current user can access.
            $result = forum_get_posts_by_user($user, $courses, $isspecificcourse, $discussionsonly, ($page * $perpage), $perpage);
            
            
            admin
            echo $OUTPUT->header();
            
            
            
            echo $OUTPUT->footer();
            
            
            $categories = $DB->get_records('user_info_category', null, 'sortorder ASC');
            
            $PAGE->set_url('/user/profile.php', array('id'=>$userid));
            
            
            
            /*
@return -> lista de cursos agrupados por categorias
*/
            if (!function_exists('categories_courses')) {

            function categories_courses(){
                    return "SELECT cc.id as categoryid, cc.name as categoryname,
                            cc.parent as parent, c.id as courseid, c.fullname as coursename
                            FROM mdl_course_categories as cc 
                            LEFT JOIN mdl_course as c ON c.category = cc.id 
                            ORDER BY cc.sortorder,c.sortorder ASC";
            }}

            
             $qry = "SELECT l.*, u.firstname, u.lastname, u.picture
                     FROM {mnet_log} l
                     LEFT JOIN {user} u ON l.userid = u.id
                     WHERE ";
              $params = array();

              $where .= "l.hostid = :hostid";
              $params['hostid'] = $hostid;          


echo $OUTPUT->header();
echo $OUTPUT->main_content(include($path));                                             // <<< HTML OUTPUT
echo $OUTPUT->footer();


        $query = 'SELECT qa.*
		  FROM mdl_quiz_attempts AS qa 
		  INNER JOIN mdl_quiz AS q 
		  ON q.id=qa.quiz 
                  WHERE q.course ='.$idCourse.' AND qa.userid = '.$idStudent.'
                  ORDER BY qa.attempt desc';
            
    // just one record
        $thecourse = "SELECT * FROM hdm_courses WHERE id_moodle = '".$COURSE->id."'  ";
        $thec = $DB->get_record_sql($thecourse);
        echo '<p>Acción '.$thec->accion_formativa.'    Nº Grupo '.$thec->grupo.'</p>'; 
        
        
 /**
 * Attain a Lock on a User's Register
 * @param object $register
 * @param int $userId
 */
function attendanceregister__attain_lock($register, $userId) {
    global $DB;
    $lock = new stdClass();
    $lock->register = $register->id;
    $lock->userid = $userId;
    $lock->takenon = time();
    $DB->insert_record('attendanceregister_lock', $lock);
} 



    // Generate generic Excel file for download 
    static function generate_download($download_name, $rows) {
        global $CFG;

        require_once($CFG->libdir. '/excellib.class.php');

        $workbook = new MoodleExcelWorkbook('-', 'excel5');
        $workbook->send(clean_filename($download_name));

        $myxls = $workbook->add_worksheet(get_string('pluginname', 'block_dedication'));

        $row_count = 0;
        foreach ($rows as $row) {
            foreach ($row as $index => $content) {
                $myxls->write($row_count, $index, $content);
            }
            $row_count++;
        }

        $workbook->close();

        return $workbook;
    }
    
    // table
    
    $table=new html_table();
    $table->head=array('Student','Grade','Comments');
    $table->data=array(
    array('Harry Potter','76%','Getting better'),
    array('Rincewind','89%','Lucky as usual'),
    array('Elminster Aumar','100%','Easy when you know everything!')
    );
    echo html_writer::table($table);
    
    
    $user=$DB->get_records_sql('SELECT * FROM {user} WHERE deleted = ? AND id > ?',array(0,1));
    
    $table = new html_table();
    $table->head = array('Lastname', 'Firstname', 'City');
    foreach ($user as $myusers) {
    $table->data[] = array($myusers->firstname, $myusers->email, $myusers->city);
    }
    echo html_writer::table($table);
    
    
    // dynamic table
    
    echo '<h5>'.count($ms).' Exámenes</h5>';
    $table = new html_table();
    $myheadarray = array('NIF', ' Nombre',' Primer Acceso', 'Tiempo Total');
    $mys = getmyscorms($c);
    foreach ($mys as $s) {
    	array_push( $myheadarray, $s->name);
    }
    array_push( $myheadarray, '%');
     
    $table->head = $myheadarray;
    foreach ($students as $myusers) {
    	$fa = getmyfirstaccess($c, $myusers->id);
    	if ($fa->timecreated) {
    		$userfa = userdate($fa->timecreated);
    	} else {
    		$userfa = '<span class="label label-danger">No acceso</span>';
    	}
    	$timededication = user_time($myusers->id);
    
    	if ($timededication==get_string('now')) { $mytime='<span class="label label-danger"><span class="glyphicon glyphicon-time"></span> </span>';} else {
    		$mytime = '<span class="glyphicon glyphicon-time"></span> '.$timededication;
    	}
    
    	$myarray = array('<a href="'.$CFG->wwwroot.'/user/profile.php?id='.$myusers->id.'">'.$myusers->firstname.'</a>',
    			$myusers->lastname, $userfa, $mytime);
        
    	$mys = getmyscorms($c);
    	$ns = 0;
    	foreach ($mys as $s) {
       		$isattempt = getmyscorms_att($myusers->id, $s->id);
    		if ($isattempt) {
    			$ns++;
    			$att = '<span  class="label label-primary">Ok</span>';
    		} else {
    			$att = '-';
    		}
    
    		array_push( $myarray, $att);
    	}
    
    	$t = ($ns/count($ms)*100);
    	array_push( $myarray, $t.'%');
       
    	$table->data[] = $myarray;
    }
    echo html_writer::start_tag('div', array('class'=>'mytable'));
    echo html_writer::table($table);
    echo html_writer::end_tag('div');
    
    // dynamic table
    
    

    
    // table
    
    echo $OUTPUT->continue_button(new moodle_url('http://domain.com/index.php',array('id'=>2,'userid'=>4)));
    
    
    
    
    // calendar
    
    $myevent=$DB->get_record_sql('SELECT * FROM {event} WHERE courseid = ? LIMIT 1 ',array($COURSE->id));
    echo $myevent->name.$myevent->id;  

    if (!$myevent){
    $event = new stdClass;
    $event->name         = "Inicio del Curso ".$COURSE->fullname;
    $event->description  = "Tiene el comienzo el Curso ".$COURSE->fullname;
    $event->groupid      = 0;
    $event->userid       = 0;
    $event->courseid     = $COURSE->id;
    $event->timestart    = time();
    $event->visible      = 1;
    $event->timeduration = 1000;
    $event->eventtype    = 'open';
    $event->sequence     = 1;
    calendar_event::create($event);
    } 
    
    // calendar
    
    // capabilities
    
       $context = get_context_instance(CONTEXT_COURSE, $COURSE->id);
        if (has_capability('moodle/course:viewhiddensections', $context)) {
            echo "Tiene privilegios";
        }
        
        // Get course details.
        $course = null;
        if ($id) {
        	$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
        	require_login($course);
        	$context = context_course::instance($course->id);
        } else {
        	require_login();
        	$context = context_system::instance();
        	$PAGE->set_context($context);
        }
        
        require_capability('report/log:view', $context);
        
        echo $CFG->siteadmins;
        if  is_siteadmin($user->id) {
        	echo "Admin";
        }
    
    // capabilities
        
        
        $this->myquestionnaire = $DB->get_record('questionnaire', array('course' => $COURSE->id) );
        $thelogos = $this->myquestionnaire->ptype.'.png';
        
   
    // sql
    
        $sql = "SELECT DISTINCT ra.roleid AS id
                FROM {role_assignments} ra
            	WHERE ra.contextid = :contextid AND ra.userid = :userid";
        $ras = $DB->get_records_sql($sql, array('contextid'=>$coursecontext->id, 'userid'=>$USER->id));

   // sql
   

        $CFG->wwwroot   = 'http://'.$_SERVER['HTTP_HOST'];
        
   // myclass
        
        class myspace {
        
        	public function get_my_courses(){
        		global $USER;
        		$mycourses = enrol_get_all_users_courses($USER->id, true, 'summary, summaryformat', 'visible DESC,sortorder ASC');
        		return $mycourses;
        	}
        
        
        	public function get_my_context($c, $cs, $csf) {
        		$context = context_course::instance($c);
        		$summary = file_rewrite_pluginfile_urls($cs, 'pluginfile.php', $context->id, 'course', 'summary', null);
        		$summary = format_text($summary, $csf, $options, $c);
        		return $summary;
        	}
        
        
        	public function get_my_render() {
        		global $COURSE, $CFG;
        
        		$output = '<div>';
        		$output .= $COURSE->id;
        		$output .= '<p>FFP System</p>';
        		$mycourses = $this->get_my_courses();
        		$output .= 'Cursos Matriculados';
        		$output .= '<ul>';
        		foreach ($mycourses as $usercourses) {
        			$output .= '<li><a href="'.$CFG->wwwroot.'/course/view.php?id='.$usercourses->id.'">'.$usercourses->fullname;
        			$mycontext = $this->get_my_context($usercourses->id, $usercourses->summary, $usercourses->summaryformat);
        			$output .= $mycontext;
        			$output .= '</a></li>';
        		}
        		$output .= '</ul>';
        		$output .= '</div>';
        		return $output;
        	}
        
        
        }
        
        $myspace = new myspace();
        echo $myspace->get_my_render();

   // myclass
        
        echo $OUTPUT->confirm('Are you sure?', '/index.php?delete=1', '/index.php');
        
   // userrole
   
        function get_my_role($u) {
        	global $DB;
        	$sql = "SELECT  min(mdl_role.shortname) as userrol FROM mdl_user
            INNER JOIN mdl_role_assignments ON mdl_role_assignments.userid = mdl_user.id
            INNER JOIN mdl_role ON mdl_role.id = mdl_role_assignments.roleid
            WHERE mdl_user.id='".$u."'";
        	$user = $DB->get_record_sql($sql);
        	return $user;
        }
        
  // userrole
  
	    function getmylastaccess($c, $u) {
	        global $DB;
	        $mylastaccess = $DB->get_record_sql('SELECT timecreated FROM {logstore_standard_log} WHERE userid = :myuserid AND courseid = :mycourseid ORDER BY id DESC',
	                                             array('myuserid'=>$u, 'mycourseid'=>$c) );
	        return $mylastaccess;
	    }
	    
	    
	// time
	
	    userdate(time());
	    format_time(time()-$lastaccess);
	    
	    require_once($CFG->dirroot.'/mod/scorm/locallib.php');
	    scorm_format_duration($tt)
	    
	    
	// context 2.7 upper
	
	    $usercontext = context_user::instance($USER->id);
	    $usercontext = context_user::instance($USER->id, 15); // use context of userid 15
	    
	    $coursecontext = context_course::instance($course->id);
	    
	    require_capability('moodle/course:sectionvisibility', $usercontext);
	    
    // context
	
	    
	// class

	    
    class myuserinfo{
    	
    	/**
    	 * User last access in courses
    	 *
    	 * param int $c courseid
    	 * param int $u userid
    	 * @return timestamp lastaccess in course recorded in log (ver 2.7 upper)
    	 */
    	function getthelog($c,$u){
    		global $DB;
       		$mylogs =  $DB->get_record_sql('SELECT timecreated FROM {logstore_standard_log} 
       										WHERE courseid = ? AND userid = ? 
       										ORDER BY id ASC LIMIT 0,1', 
                       						array($c, $u));
    		return $mylogs;
    	}  	
    }
	     
	    
	    $mt = myuserinfo::getthelog(2,2);
	
	// class
	
	    
	    $this->title = isset($this->config->title) ? $this->config->title : 'Informes';
	    
	// update
	
	    $table = 'course';
	    $dataobject -> id = '4';
	    $dataobject -> fullname = 'PHP new Course Named by FFP';
	    $DB->update_record($table, $dataobject);
	     
	    $c = 6;
	    $mytext = 'MySQL new by FFP';
	    $sql = "UPDATE mdl_course SET fullname ='".$mytext."' WHERE id ='".$c."' ";
	    $DB->execute($sql);
	    
	// update
	
	// recordset
	
	    $mycn = $DB->get_recordset('course', array('category'=>$cc));
	    
	    $mycn->close();
	    
	// recordset
?>



