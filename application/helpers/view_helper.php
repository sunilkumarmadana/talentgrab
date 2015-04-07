<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function view_date($date) {
    return htmlspecialchars(date('M d, Y', strtotime($date)));
}

function http_url($path = '/') {
    if(substr($path, 0, 1) != '/') {
        $path = '/'.$path;
    }

    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
        $url =  'http://'.$_SERVER["HTTP_HOST"].$path;
    } else {
        $url =  $path;
    }
    return $url;
}

function https_url($path, $fullpath=false) {
    if(substr($path, 0, 1) != '/') {
        $path = '/'.$path;
    }

    if($fullpath) {
        $url =  'https://'.$_SERVER["HTTP_HOST"].$path;
    } else if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
        $url =  $path;
    } else {
        $url =  'https://'.$_SERVER["HTTP_HOST"].$path;
    }
    return $url;
}

function view_salary($currency, $min, $max) {

    if(!empty($min) && floatval($min) > 0 && !empty($max) && floatval($max) > 0) {
        $salary = $currency.' '.$min.' - '.$max;
    } else if (!empty($min) && floatval($min) > 0) {
        $salary = $currency.' '.$min.' +';
    } else if (!empty($max) && floatval($max) > 0) {
        $salary = 'up to '.$currency.' '.$max;
    } else {
        $salary = 'Negotiable';
    }
    return htmlspecialchars($salary);
}

function view_title($value) {
    $title_list = array(
        '' => 'Please select',
        'Mr.' => 'Mr.',
        'Ms.' => 'Ms.',
        'Mrs.' => 'Mrs.',
        'Dr.' => 'Dr.',
        'Prof.' => 'Prof.',
    );
    foreach($title_list as $k => $v) {
        if ($value == $k) {
            echo '<option value="'.$k.'" selected="selected">'.$v.'</option>';
        } else {
            echo '<option value="'.$k.'">'.$v.'</option>';
        }
    }
}

function view_phone_area($value) {
    $phonearea_list = array(
        '' => 'SG ( +65)',
        'dummy1' => '-',
        'SG ( +65)' => 'SG ( +65)',
        'MY ( +60)' => 'MY ( +60)',
        'JP ( +81)' => 'JP ( +81)',
        'HK ( +852)' => 'HK ( +852)',
        'CN ( +86)' => 'CN ( +86)',
        'IN ( +91)' => 'IN ( +91)',
        'ID ( +62)' => 'ID ( +62)',
        'dummy2' => '-',
        'AF ( +93)' => 'AF ( +93)',
        'AL ( +355)' => 'AL ( +355)',
        'DZ ( +213)' => 'DZ ( +213)',
        'AS ( +1 684)' => 'AS ( +1 684)',
        'AD ( +376)' => 'AD ( +376)',
        'AO ( +244)' => 'AO ( +244)',
        'AI ( +1 264)' => 'AI ( +1 264)',
        'AQ ( +672)' => 'AQ ( +672)',
        'AG ( +1 268)' => 'AG ( +1 268)',
        'AR ( +54)' => 'AR ( +54)',
        'AM ( +374)' => 'AM ( +374)',
        'AW ( +297)' => 'AW ( +297)',
        'AU ( +61)' => 'AU ( +61)',
        'AT ( +43)' => 'AT ( +43)',
        'AZ ( +994)' => 'AZ ( +994)',
        'BS ( +1 242)' => 'BS ( +1 242)',
        'BH ( +973)' => 'BH ( +973)',
        'BD ( +880)' => 'BD ( +880)',
        'BB ( +1 246)' => 'BB ( +1 246)',
        'BY ( +375)' => 'BY ( +375)',
        'BE ( +32)' => 'BE ( +32)',
        'BZ ( +501)' => 'BZ ( +501)',
        'BJ ( +229)' => 'BJ ( +229)',
        'BM ( +1 441)' => 'BM ( +1 441)',
        'BT ( +975)' => 'BT ( +975)',
        'BO ( +591)' => 'BO ( +591)',
        'BA ( +387)' => 'BA ( +387)',
        'BW ( +267)' => 'BW ( +267)',
        'BR ( +55)' => 'BR ( +55)',
        'VG ( +1 284)' => 'VG ( +1 284)',
        'BN ( +673)' => 'BN ( +673)',
        'BG ( +359)' => 'BG ( +359)',
        'BF ( +226)' => 'BF ( +226)',
        'MM ( +95)' => 'MM ( +95)',
        'BI ( +257)' => 'BI ( +257)',
        'KH ( +855)' => 'KH ( +855)',
        'CM ( +237)' => 'CM ( +237)',
        'CA ( +1)' => 'CA ( +1)',
        'CV ( +238)' => 'CV ( +238)',
        'KY ( +1 345)' => 'KY ( +1 345)',
        'CF ( +236)' => 'CF ( +236)',
        'TD ( +235)' => 'TD ( +235)',
        'CL ( +56)' => 'CL ( +56)',
        'CX ( +61)' => 'CX ( +61)',
        'CC ( +61)' => 'CC ( +61)',
        'CO ( +57)' => 'CO ( +57)',
        'KM ( +269)' => 'KM ( +269)',
        'CK ( +682)' => 'CK ( +682)',
        'CR ( +506)' => 'CR ( +506)',
        'HR ( +385)' => 'HR ( +385)',
        'CU ( +53)' => 'CU ( +53)',
        'CY ( +357)' => 'CY ( +357)',
        'CZ ( +420)' => 'CZ ( +420)',
        'CD ( +243)' => 'CD ( +243)',
        'DK ( +45)' => 'DK ( +45)',
        'DJ ( +253)' => 'DJ ( +253)',
        'DM ( +1 767)' => 'DM ( +1 767)',
        'DO ( +1 809)' => 'DO ( +1 809)',
        'EC ( +593)' => 'EC ( +593)',
        'EG ( +20)' => 'EG ( +20)',
        'SV ( +503)' => 'SV ( +503)',
        'GQ ( +240)' => 'GQ ( +240)',
        'ER ( +291)' => 'ER ( +291)',
        'EE ( +372)' => 'EE ( +372)',
        'ET ( +251)' => 'ET ( +251)',
        'FK ( +500)' => 'FK ( +500)',
        'FO ( +298)' => 'FO ( +298)',
        'FJ ( +679)' => 'FJ ( +679)',
        'FI ( +358)' => 'FI ( +358)',
        'FR ( +33)' => 'FR ( +33)',
        'PF ( +689)' => 'PF ( +689)',
        'GA ( +241)' => 'GA ( +241)',
        'GM ( +220)' => 'GM ( +220)',
        'GE ( +995)' => 'GE ( +995)',
        'DE ( +49)' => 'DE ( +49)',
        'GH ( +233)' => 'GH ( +233)',
        'GI ( +350)' => 'GI ( +350)',
        'GR ( +30)' => 'GR ( +30)',
        'GL ( +299)' => 'GL ( +299)',
        'GD ( +1 473)' => 'GD ( +1 473)',
        'GU ( +1 671)' => 'GU ( +1 671)',
        'GT ( +502)' => 'GT ( +502)',
        'GN ( +224)' => 'GN ( +224)',
        'GW ( +245)' => 'GW ( +245)',
        'GY ( +592)' => 'GY ( +592)',
        'HT ( +509)' => 'HT ( +509)',
        'VA ( +39)' => 'VA ( +39)',
        'HN ( +504)' => 'HN ( +504)',
        'HU ( +36)' => 'HU ( +36)',
        'IS ( +354)' => 'IS ( +354)',
        'IR ( +98)' => 'IR ( +98)',
        'IQ ( +964)' => 'IQ ( +964)',
        'IE ( +353)' => 'IE ( +353)',
        'IM ( +44)' => 'IM ( +44)',
        'IL ( +972)' => 'IL ( +972)',
        'IT ( +39)' => 'IT ( +39)',
        'CI ( +225)' => 'CI ( +225)',
        'JM ( +1 876)' => 'JM ( +1 876)',
        'JO ( +962)' => 'JO ( +962)',
        'KZ ( +7)' => 'KZ ( +7)',
        'KE ( +254)' => 'KE ( +254)',
        'KI ( +686)' => 'KI ( +686)',
        'KW ( +965)' => 'KW ( +965)',
        'KG ( +996)' => 'KG ( +996)',
        'LA ( +856)' => 'LA ( +856)',
        'LV ( +371)' => 'LV ( +371)',
        'LB ( +961)' => 'LB ( +961)',
        'LS ( +266)' => 'LS ( +266)',
        'LR ( +231)' => 'LR ( +231)',
        'LY ( +218)' => 'LY ( +218)',
        'LI ( +423)' => 'LI ( +423)',
        'LT ( +370)' => 'LT ( +370)',
        'LU ( +352)' => 'LU ( +352)',
        'MO ( +853)' => 'MO ( +853)',
        'MK ( +389)' => 'MK ( +389)',
        'MG ( +261)' => 'MG ( +261)',
        'MW ( +265)' => 'MW ( +265)',
        'MV ( +960)' => 'MV ( +960)',
        'ML ( +223)' => 'ML ( +223)',
        'MT ( +356)' => 'MT ( +356)',
        'MH ( +692)' => 'MH ( +692)',
        'MR ( +222)' => 'MR ( +222)',
        'MU ( +230)' => 'MU ( +230)',
        'YT ( +262)' => 'YT ( +262)',
        'MX ( +52)' => 'MX ( +52)',
        'FM ( +691)' => 'FM ( +691)',
        'MD ( +373)' => 'MD ( +373)',
        'MC ( +377)' => 'MC ( +377)',
        'MN ( +976)' => 'MN ( +976)',
        'ME ( +382)' => 'ME ( +382)',
        'MS ( +1 664)' => 'MS ( +1 664)',
        'MA ( +212)' => 'MA ( +212)',
        'MZ ( +258)' => 'MZ ( +258)',
        'NA ( +264)' => 'NA ( +264)',
        'NR ( +674)' => 'NR ( +674)',
        'NP ( +977)' => 'NP ( +977)',
        'NL ( +31)' => 'NL ( +31)',
        'AN ( +599)' => 'AN ( +599)',
        'NC ( +687)' => 'NC ( +687)',
        'NZ ( +64)' => 'NZ ( +64)',
        'NI ( +505)' => 'NI ( +505)',
        'NE ( +227)' => 'NE ( +227)',
        'NG ( +234)' => 'NG ( +234)',
        'NU ( +683)' => 'NU ( +683)',
        'KP ( +850)' => 'KP ( +850)',
        'MP ( +1 670)' => 'MP ( +1 670)',
        'NO ( +47)' => 'NO ( +47)',
        'OM ( +968)' => 'OM ( +968)',
        'PK ( +92)' => 'PK ( +92)',
        'PW ( +680)' => 'PW ( +680)',
        'PA ( +507)' => 'PA ( +507)',
        'PG ( +675)' => 'PG ( +675)',
        'PY ( +595)' => 'PY ( +595)',
        'PE ( +51)' => 'PE ( +51)',
        'PH ( +63)' => 'PH ( +63)',
        'PN ( +870)' => 'PN ( +870)',
        'PL ( +48)' => 'PL ( +48)',
        'PT ( +351)' => 'PT ( +351)',
        'PR ( +1)' => 'PR ( +1)',
        'QA ( +974)' => 'QA ( +974)',
        'CG ( +242)' => 'CG ( +242)',
        'RO ( +40)' => 'RO ( +40)',
        'RU ( +7)' => 'RU ( +7)',
        'RW ( +250)' => 'RW ( +250)',
        'BL ( +590)' => 'BL ( +590)',
        'SH ( +290)' => 'SH ( +290)',
        'KN ( +1 869)' => 'KN ( +1 869)',
        'LC ( +1 758)' => 'LC ( +1 758)',
        'MF ( +1 599)' => 'MF ( +1 599)',
        'PM ( +508)' => 'PM ( +508)',
        'VC ( +1 784)' => 'VC ( +1 784)',
        'WS ( +685)' => 'WS ( +685)',
        'SM ( +378)' => 'SM ( +378)',
        'ST ( +239)' => 'ST ( +239)',
        'SA ( +966)' => 'SA ( +966)',
        'SN ( +221)' => 'SN ( +221)',
        'RS ( +381)' => 'RS ( +381)',
        'SC ( +248)' => 'SC ( +248)',
        'SL ( +232)' => 'SL ( +232)',
        'SK ( +421)' => 'SK ( +421)',
        'SI ( +386)' => 'SI ( +386)',
        'SB ( +677)' => 'SB ( +677)',
        'SO ( +252)' => 'SO ( +252)',
        'ZA ( +27)' => 'ZA ( +27)',
        'KR ( +82)' => 'KR ( +82)',
        'ES ( +34)' => 'ES ( +34)',
        'LK ( +94)' => 'LK ( +94)',
        'SD ( +249)' => 'SD ( +249)',
        'SR ( +597)' => 'SR ( +597)',
        'SZ ( +268)' => 'SZ ( +268)',
        'SE ( +46)' => 'SE ( +46)',
        'CH ( +41)' => 'CH ( +41)',
        'SY ( +963)' => 'SY ( +963)',
        'TW ( +886)' => 'TW ( +886)',
        'TJ ( +992)' => 'TJ ( +992)',
        'TZ ( +255)' => 'TZ ( +255)',
        'TH ( +66)' => 'TH ( +66)',
        'TL ( +670)' => 'TL ( +670)',
        'TG ( +228)' => 'TG ( +228)',
        'TK ( +690)' => 'TK ( +690)',
        'TO ( +676)' => 'TO ( +676)',
        'TT ( +1 868)' => 'TT ( +1 868)',
        'TN ( +216)' => 'TN ( +216)',
        'TR ( +90)' => 'TR ( +90)',
        'TM ( +993)' => 'TM ( +993)',
        'TC ( +1 649)' => 'TC ( +1 649)',
        'TV ( +688)' => 'TV ( +688)',
        'UG ( +256)' => 'UG ( +256)',
        'UA ( +380)' => 'UA ( +380)',
        'AE ( +971)' => 'AE ( +971)',
        'GB ( +44)' => 'GB ( +44)',
        'US ( +1)' => 'US ( +1)',
        'UY ( +598)' => 'UY ( +598)',
        'VI ( +1 340)' => 'VI ( +1 340)',
        'UZ ( +998)' => 'UZ ( +998)',
        'VU ( +678)' => 'VU ( +678)',
        'VE ( +58)' => 'VE ( +58)',
        'VN ( +84)' => 'VN ( +84)',
        'WF ( +681)' => 'WF ( +681)',
        'YE ( +967)' => 'YE ( +967)',
        'ZM ( +260)' => 'ZM ( +260)',
        'ZW ( +263)' => 'ZW ( +263)',
    );
    foreach($phonearea_list as $k => $v) {
        if ($v == '-') {
            echo '<option class="select-dash" disabled="disabled">----</option>';
        } else {
            if ($value == $k) {
                echo '<option value="'.$k.'" selected="selected">'.$v.'</option>';
            } else {
                echo '<option value="'.$k.'">'.$v.'</option>';
            }
        }
    }
}

function view_visa_status($value) {
    $visa_status_list = array(
        '' => 'Please select',
        "Singaporean" => "Singaporean",
        "Permanent Resident" => "Permanent Resident",
        "Employment Pass" => "Employment Pass",
        "S-Pass" => "S-Pass",
        "Dependant Pass" => "Dependant Pass",
        "Others" => "Others",
        "Not Applicable" => "Not Applicable",
    );
    foreach($visa_status_list as $k => $v) {
        if ($value == $k) {
            echo '<option value="'.$k.'" selected="selected">'.$v.'</option>';
        } else {
            echo '<option value="'.$k.'">'.$v.'</option>';
        }
    }
}

function view_education_level($value) {
    $education_level_list = array(
        '' => 'Please select',
        "Ph.D" => "Ph.D",
        "Master" => "Master",
        "Bachelor" => "Bachelor",
        "Diploma" => "Diploma",
        "High School (A-levels)" => "High School (A-levels)",
        "Secondary School (O-levels)" => "Secondary School (O-levels)",
    );
    foreach($education_level_list as $k => $v) {
        if ($value == $k) {
            echo '<option value="'.$k.'" selected="selected">'.$v.'</option>';
        } else {
            echo '<option value="'.$k.'">'.$v.'</option>';
        }
    }
}

function view_language_level($value) {
    $language_select_list = array(
        '' => 'Please select',
        'Native' => 'Native',
        'Business Level' => 'Business Level',
        'Conversational' => 'Conversational',
        'None' => 'None',
    );

    foreach($language_select_list as $k => $v) {
        if ($value == $k) {
            echo '<option value="'.$k.'" selected="selected">'.$v.'</option>';
        } else {
            echo '<option value="'.$k.'">'.$v.'</option>';
        }
    }
}

if ( ! function_exists('validation_exist_error'))
{
    function validation_exist_error($message)
    {
        if (FALSE === ($OBJ =& _get_validation_object()))
        {
            return '';
        }
        return $OBJ->exist_error($message);
    }
}

if ( ! function_exists('validation_exist_error_except'))
{
    function validation_exist_error_except($ignore_message_array)
    {
        if (FALSE === ($OBJ =& _get_validation_object()))
        {
            return '';
        }
        return $OBJ->exist_error_except($ignore_message_array);
    }
}

/**
 * Validation Object
 *
 * Determines what the form validation class was instantiated as, fetches
 * the object and returns it.
 *
 * @access	private
 * @return	mixed
 */
if ( ! function_exists('_get_validation_object'))
{
    function &_get_validation_object()
    {
        $CI =& get_instance();

        // We set this as a variable since we're returning by reference.
        $return = FALSE;

        if (FALSE !== ($object = $CI->load->is_loaded('form_validation')))
        {
            if ( ! isset($CI->$object) OR ! is_object($CI->$object))
            {
                return $return;
            }

            return $CI->$object;
        }

        return $return;
    }
}

/* ./application/helpers/view_helper.php */
?>
