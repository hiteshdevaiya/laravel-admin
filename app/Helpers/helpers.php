<?php

use App\Models\Settings;
use App\Models\Users;
use App\Models\Modules;
use App\Models\Roles;
use App\Models\UserAccessModules;
use App\Models\RoleAccessModules;
use App\Models\Status;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Stringy\Stringy;


// encode id
if(!function_exists('base64UrlEncode'))
{
    function base64UrlEncode($input){
        return strtr(base64_encode(Crypt::encrypt($input)), '+/=', '._-'); // "+", "/" and "=" are not url safe
    }
}

// decode id 
if(!function_exists('base64UrlDecode'))
{
    function base64UrlDecode($input){
        try {
            return Crypt::decrypt(base64_decode(strtr($input, '._-', '+/=')));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}

// bradcumb
if(!function_exists('getBreadcumb'))
{
    function getBreadcumb($module,$titleModule,$parentRoute){
        $html = '<div class="row">';
            $html .= '<div class="col-12">';
                $html .='<div class="page-title-box d-flex align-items-center justify-content-between">';
                $html .= '<h4 class="mb-0 font-size-18">'.$titleModule.'</h4>';
                    $html .= '<div class="page-title-right">';
                        $html .= '<ol class="breadcrumb m-0">';
                            $html .= '<li class="breadcrumb-item"><a href="'.route('admin.dashboard').'">Dashboard</a></li>';
                            $html .= '<li class="breadcrumb-item"><a href="'.route($parentRoute).'">'.$module.'</a></li>';
                            $html .= '<li class="breadcrumb-item active">'.ucfirst($titleModule).'</li>';
                        $html .= '</ol>';
                    $html .= '</div>';
                $html .= '</div>';
            $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}

//get dropdown with selected task
if(!function_exists('getStatusDropdown'))
{
    function getStatusDropdown($taskId,$selected=""){
        $html = '<option value="">Select status</option>';
        $status = Status::get();
        if(count($status)>0){
            foreach($status as $one){
                $html .= '<option value="'.$one->id.'"';
                if($selected != "" && $selected == $one->id){
                    $html .= 'selected';
                }
                $html .= '>'.$one->name.'</option>';
            }
        }
        return $html;
    }
}


if(!function_exists('checkRolePermission'))
{
    function checkRolePermission($roleid,$moduleid){
        $check = RoleAccessModules::where(array('role_id' => $roleid,'module_id' => $moduleid))->first();
        return $check;
    }
}

if(!function_exists('checkUserPermission'))
{
    function checkUserPermission($userid,$moduleid){
        $check = UserAccessModules::where(array('user_id' => $userid,'module_id' => $moduleid))->first();
        return $check;
    }
}


if(!function_exists('templateUrl'))
{
    function templateUrl($path=""){
        return publicUrl("assets/".$path);
    }
}
if(!function_exists('publicUrl'))
{
    function publicUrl($path=""){
        return asset('public/'.$path);
    }
}

if(!function_exists('checkCurrentUrl'))
{
    function checkCurrentUrl($url=""){
        $return = Request::is($url) ? 'mm-active' : '';
        return $return;
    }
}


function TimeToServer($DateAndTime)
{
    //echo $this->TimeZoneOffset;
    if ($DateAndTime == '') {
        $datetime = new DateTime();
    } else {
        $datetime = new DateTime($DateAndTime);
    }
    $la_time = new DateTimeZone('America/Los_Angeles');
    $datetime->setTimezone($la_time);
    return $datetime->format('Y-m-d H:i:s');
}

function sign($number)
{
    return ($number > 0) ? 1 : (($number < 0) ? -1 : 0);
}

if(!function_exists('replace_keywords')) {
    function replace_keywords($array, $message)
    {
        foreach ($array as $k => $v) {
            $message = str_replace($k, $v, $message);
        }
        return $message;
    }
}

if(!function_exists('get_messages')){
    function get_messages($message,$type){
        if($type == 1){
            return '<div class="alert alert-success">'.$message.'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
        }else{
            return '<div class="alert alert-danger">'.$message.'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
        }
    }
}

if(!function_exists('get_settings')){
    function get_settings() {
        $settings = settings::first();
        return (!empty($settings) ? $settings->toArray() : $settings);
    }
}

if(!function_exists('get_user_access_modules')){
    function get_user_access_modules($user_id) {
        $moduleIdArray =[];
        $usersAccessModules  = User_access_modules::get();
        if(!empty($usersAccessModules)){
            $application_module  = User_access_modules::with(['userrole', 'application_modules'])->where(['user_role_id' => $user_id])->get()->toArray();
            foreach ($application_module as $module_id){
                $moduleIdArray[] = $module_id['application_modules']['module'];
            }
        }
        return $moduleIdArray;
    }
}

if(!function_exists('get_user_role')){
    function get_user_role($user_id) {
        $userDetails = Users::with(['user_assigned_role', 'user_roles'])->where(array('id' => $user_id))->first()->toArray();
        return $userDetails;
    }
}

if(!function_exists('get_check_access')){
    function get_check_access($module_type){
        $moduleId = Application_modules::where('module', $module_type)->first()->id;
        $userRoleID = Users::with('user_roles')->whereIn('id', [Auth::id()])->first()->user_roles[0]->id;
        $userRolePermissionId = Role_access_modules::where('role_id', $userRoleID)->where('application_module_id', $moduleId)->first();
        if (Gate::allows('access',$userRolePermissionId)) {
            return 1;
        }
        else{
            return 0;
        }
        /// return $this->userRolePermissionId;
    }
}
if(!function_exists('get_access')){
    function get_access($module_type,$type){
        $moduleId = Application_modules::where('module', $module_type)->first()->id;
        $userRoleID = Users::with('user_roles')->whereIn('id', [Auth::id()])->first()->user_roles[0]->id;
        $userRolePermissionId = Role_access_modules::where('role_id', $userRoleID)->where('application_module_id', $moduleId)->first();
        if (Gate::allows($type,$userRolePermissionId)) {
            return 1;
        }
        else{
            return 0;
        }
    }
}

if(!function_exists('get_user_check_access')){
    function get_user_check_access($module_type,$type){
        $moduleId = Application_modules::where('module', $module_type)->get()->toArray();
        $userRoleID = Users::with('user_roles')->whereIn('id', [Auth::id()])->first()->user_roles[0]->id;
        $userRolePermissionId = User_access_modules::where('user_id', Auth::id())->where('application_module_id', $moduleId)->first();
        if(!empty($userRolePermissionId)){
            if (Gate::allows($type,$userRolePermissionId)) {
                return 1;
            }
            else{
                return 0;
            }
        }else{
            return 0;
        }

    }
}

if(!function_exists('get_sub_user_access')){
    function get_sub_user_access($user_id){
        return User_access_modules::with(['application_modules'])->where(array('user_id' => $user_id,'create'=>1,'edit'=>1,'delete'=>1,'view'=>1,'access'=>1))->get()->toArray();
        //return Role_access_modules::where(array('role_id'=>3,'create'=>1,'edit'=>1,'delete'=>1,'view'=>1,'access'=>1))->get()->toArray();
    }
}

if(!function_exists('get_usermarketplace')){
    function get_usermarketplace($user_id){
        return Usermarketplace::with('mws_market_place_country')->where(array('user_id'=>$user_id))->get()->toArray();
    }
}


function add_to_path($path)
{
    $lib_path = app_path($path);
    $include_path = get_include_path();
    if (!str_contains($include_path, $lib_path)) {
        set_include_path($include_path . PATH_SEPARATOR . $lib_path);
    }
}


if(!function_exists('get_authenticate_user')){
    function get_authenticate_user($user_id,$token) {
        $userDetails = Usermarketplace::where(array('id' => $user_id,'api_token'=>$token))->first();
        return $userDetails;
    }
}

if(!function_exists('get_country_fullname')){
    function get_country_fullname($code) {
        $data = get_country_list();
        $name = "";
        if(!empty($data)){
            foreach($data as $key => $data1){
                if($code == $key){
                    $name = $data1;
                    break;
                }
            }
        }
        return $name;
    }
}

if(!function_exists('get_state_fullname')){
    function get_state_fullname($cn_code,$st_code) {
        $data = get_state_list($cn_code);

        $name = "";
        if(!empty($data)){
            foreach($data as $key => $data1){
                if($st_code == $key){
                    $name = $data1;
                    break;
                }
            }
        }
        return $name;
    }
}

if(!function_exists('get_city_fullname')){
    function get_city_fullname($cn_code,$st_code,$ct_code) {
        $data = get_city_list($st_code);
        
        $name = "";
        if(!empty($data)){
            foreach($data as $key => $data1){
                if($ct_code == $key){
                    $name = $data1;
                    break;
                }
            }
        }
        return $name;
    }
}

if(!function_exists('get_country_list')){
    function get_country_list() {
         return array(
        "US" => "United States",
        "CA" => "Canada",
        "AF" => "Afghanistan",
        "AL" => "Albania",
        "DZ" => "Algeria",
        "AS" => "American Samoa",
        "AD" => "Andorra",
        "AI" => "Anguilla",
        "AQ" => "Antarctica",
        "AG" => "Antiqua and Barbuda",
        "AR" => "Argentina",
        "AM" => "Armenia",
        "AW" => "Aruba",
        "AU" => "Australia",
        "AT" => "Austria",
        "AZ" => "Azerbaijan",
        "BS" => "Bahamas",
        "BH" => "Bahrain",
        "BD" => "Bangladesh",
        "BB" => "Barbados",
        "BY" => "Belarus",
        "BE" => "Belgium",
        "BZ" => "Belize",
        "BJ" => "Benin",
        "BM" => "Bermuda",
        "BT" => "Bhutan",
        "BO" => "Bolivia",
        "BV" => "Bouvet Islands",
        "BR" => "Brazil",
        "IO" => "British Indian Ocean Territory",
        "VI" => "British Virgin Islands",
        "BN" => "Brunei",
        "BG" => "Bulgaria",
        "BF" => "Burkina Faso",
        "BI" => "Burundi",
        "KH" => "Cambodia",
        "CM" => "Cameroon",
        "CV" => "Cape Verde",
        "KY" => "Cayman Islands",
        "CF" => "Central African Republic",
        "TD" => "Chad",
        "CL" => "Chile",
        "CN" => "China",
        "CO" => "Colombia",
        "KM" => "Comoros",
        "CG" => "Congo",
        "CR" => "Costa Rica",
        "CI" => "Cote D'Ivoire",
        "HR" => "Croatia",
        "CW" => "Curacao",
        "CY" => "Cyprus",
        "CZ" => "Czech Republic",
        "DK" => "Denmark",
        "DJ" => "Djibouti",
        "DM" => "Dominica",
        "DO" => "Dominican Republic",
        "EG" => "Egypt",
        "SV" => "El Salvador",
        "EC" => "Equador",
        "GQ" => "Equatorial Guinea",
        "ER" => "Eritrea",
        "EE" => "Estonia",
        "ET" => "Ethiopia",
        "FK" => "Falkland Islands",
        "FO" => "Faroe Islands",
        "FM" => "Federated States of Micronesia",
        "FJ" => "Fiji",
        "FI" => "Finland",
        "FR" => "France",
        "GF" => "French Guiana",
        "PF" => "French Polynesia",
        "GA" => "Gabon",
        "GM" => "Gambia",
        "GE" => "Georgia",
        "DE" => "Germany",
        "GH" => "Ghana",
        "GI" => "Gibraltar",
        "GR" => "Greece",
        "GL" => "Greenland",
        "GD" => "Grenada",
        "GP" => "Guadeloupe",
        "GU" => "Guam",
        "GT" => "Guatemala",
        "GN" => "Guinea",
        "GW" => "Guinea-Bissau",
        "GY" => "Guyana",
        "HT" => "Haiti",
        "HN" => "Honduras",
        "HK" => "Hong Kong",
        "HU" => "Hungary",
        "IS" => "Iceland",
        "IN" => "India",
        "ID" => "Indonesia",
        "IR" => "Iran",
        "IQ" => "Iraq",
        "IE" => "Ireland",
        "IL" => "Israel",
        "IT" => "Italy",
        "JM" => "Jamaica",
        "JP" => "Japan",
        "JO" => "Jordan",
        "KZ" => "Kazakhstan",
        "KE" => "Kenya",
        "KI" => "Kiribati",
        "KW" => "Kuwait",
        "KG" => "Kyrgyzstan",
        "LA" => "Laos",
        "LV" => "Latvia",
        "LB" => "Lebanon",
        "LS" => "Lesotho",
        "LR" => "Liberia",
        "LI" => "Liechtenstein",
        "LT" => "Lithuania",
        "LU" => "Luxembourg",
        "MO" => "Macau",
        "MG" => "Madagascar",
        "MW" => "Malawi",
        "MY" => "Malaysia",
        "MV" => "Maldives",
        "ML" => "Mali",
        "MT" => "Malta",
        "MH" => "Marshall Islands",
        "MQ" => "Martinique",
        "MK" => "Macedonia",
        "MR" => "Mauritania",
        "YT" => "Mayotte",
        "FX" => "Metropolitan France",
        "MX" => "Mexico",
        "MD" => "Moldova",
        "MN" => "Mongolia",
        "MA" => "Morocco",
        "MZ" => "Mozambique",
        "NA" => "Namibia",
        "NR" => "Nauru",
        "NP" => "Nepal",
        "NL" => "Netherlands",
        "AN" => "Netherlands Antilles",
        "NC" => "New Caledonia",
        "NZ" => "New Zealand",
        "NI" => "Nicaragua",
        "NE" => "Niger",
        "NG" => "Nigeria",
        "MP" => "Northern Mariana Islands",
        "NO" => "Norway",
        "OM" => "Oman",
        "PK" => "Pakistan",
        "PW" => "Palau",
        "PA" => "Panama",
        "PG" => "Papua New Guinea",
        "PY" => "Paraguay",
        "PE" => "Peru",
        "PE" => "Peru",
        "PH" => "Philippines",
        "PN" => "Pitcairn",
        "PL" => "Poland",
        "PT" => "Portugal",
        "PR" => "Puerto Rico",
        "QA" => "Qatar",
        "KR" => "Republic of Korea",
        "RE" => "Reunion",
        "RO" => "Romania",
        "RU" => "Russia",
        "ST" => "Sao Tome and Principe",
        "SA" => "Saudi Arabia",
        "SN" => "Senegal",
        "SC" => "Seychelles",
        "SL" => "Sierra Leone",
        "SG" => "Singapore",
        "SK" => "Slovakia",
        "SI" => "Slovenia",
        "SB" => "Solomon Islands",
        "SO" => "Somalia",
        "ZA" => "South Africa",
        "ES" => "Spain",
        "LK" => "Sri Lanka",
        "SH" => "St. Helena",
        "KN" => "St. Kitts and Nevis",
        "LC" => "St. Lucia",
        "VC" => "St. Vincent and the Grenadines",
        "SD" => "Sudan",
        "SR" => "Suriname",
        "SJ" => "Svalbard and Jan Mayen Islands",
        "SZ" => "Swaziland",
        "SE" => "Sweden",
        "CH" => "Switzerland",
        "SY" => "Syria",
        "TW" => "Taiwan",
        "TJ" => "Tajikistan",
        "TZ" => "Tanzania",
        "TH" => "Thailand",
        "TG" => "Togo",
        "TO" => "Tonga",
        "TT" => "Trinidad and Tobago",
        "TR" => "Turkey",
        "TM" => "Turkmenistan",
        "TC" => "Turks and Caicos Islands",
        "TV" => "Tuvalu",
        "UG" => "Uganda",
        "UA" => "Ukraine",
        "AE" => "United Arab Emirates",
        "UK" => "United Kingdom",
        "UY" => "Uruguay",
        "UZ" => "Uzbekistan",
        "VU" => "Vanuatu",
        "VA" => "Vatican City",
        "VE" => "Venezuela",
        "VN" => "Vietnam",
        "EH" => "Western Sahara",
        "YE" => "Yemen",
        "YU" => "Yugoslavia",
        "ZR" => "Zaire",
        "ZM" => "Zambia",
        "ZW" => "Zimbabwe");

    }
}


if(!function_exists('get_state_list')){
    function get_state_list($country_code=null) {

            $data = array(

            'US'=> array(  

                "AL" => "Alabama",
                "AK" => "Alaska",
                "AZ" => "Arizona",
                "AR" => "Arkansas",
                "CA" => "California",
                "CO" => "Colorado",
                "CT" => "Connecticut",
                "DE" => "Delaware",
                "DC" => "District of Columbia",
                "FL" => "Florida",
                "GA" => "Georgia",
                "HI" => "Hawaii",
                "ID" => "Idaho",
                "IL" => "Illinois",
                "IN" => "Indiana",
                "IA" => "Iowa",
                "KS" => "Kansas",
                "KY" => "Kentucky",
                "LA" => "Louisiana",
                "ME" => "Maine",
                "MD" => "Maryland",
                "MA" => "Massachusetts",
                "MI" => "Michigan",
                "MN" => "Minnesota",
                "MS" => "Mississippi",
                "MO" => "Missouri",
                "MT" => "Montana",
                "NE" => "Nebraska",
                "NV" => "Nevada",
                "NH" => "New Hampshire",
                "NJ" => "New Jersey",
                "NM" => "New Mexico",
                "NY" => "New York",
                "NC" => "North Carolina",
                "ND" => "North Dakota",
                "OH" => "Ohio",
                "OK" => "Oklahoma",
                "OR" => "Oregon",
                "PA" => "Pennsylvania",
                "RI" => "Rhode Island",
                "SC" => "South Carolina",
                "SD" => "South Dakota",
                "TN" => "Tennessee",
                "TX" => "Texas",
                "UT" => "Utah",
                "VT" => "Vermont",
                "VA" => "Virginia",
                "WA" => "Washington",
                "WV" => "West Virginia",
                "WI" => "Wisconsin",
                "WY" => "Wyoming",
            ),
            'IN'=> array(  
                "AA" => "Alabama",
            ),
            );

            $returnData = array();
            if($country_code != null){
                if (array_key_exists($country_code, $data)){
                    $returnData = $data[$country_code]; 
                    return $returnData;
                }
            }

    }
}


if(!function_exists('get_city_list')){
    function get_city_list($state_code=null) {    
        $data = array(
                "TX"=>array(
                    "HOU" => "Houston",
                    "DA" => "DALLAS",
                ),
                "CA"=>array(
                 "SFO" => "San Francisco",
                    "SAN" => "San Diego",
                    ),
                "IL"=>array(
                   "CHI" => "chicago",
                    ),
                "MA"=>array(
                   "BOS" => "Boston",
                    ),
                "MI"=>array(
                   "DDT" => "Detroit",
                    ),
                "GA"=>array(
                   "ATL" => "Atlanta",
                    ),
                "CO"=>array(
                   "DEN" => "Denver",
                    ),
                "DC"=>array(
                   "WAS" => "Washington",
                    ),
                "NY"=>array(
                   "SYR" => "Syracuse",
                    ),
                "WA"=>array(
                   "SEA" => "SEATTLE",
                ),                                
            );  

        $returnData = array();
        if($state_code != null){
            if (array_key_exists($state_code, $data)){
                $returnData = $data[$state_code]; 
                return $returnData;
            }
        }    
    }
}