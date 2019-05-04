<?php

class Social
{
public static function GetLinks($string) //Parsing user LDAP string to links
{
    $string=str_replace(" ", "", $string); //Kill spaces
    $proto= explode(";", $string);
    for ($i=0; isset($proto[$i]); $i++){$links[$i]=explode(":", $proto[$i]);}
    for ($i=0; isset($links[$i][0]); $i++)
    {
           switch ($links[$i][0]) //rules of parsing (0 is protocol; 1 is full link; 2 is fontawesome alias)
            {
            case 'vk': $links[$i][1]="https://vk.com/".$links[$i][1]; $links[$i][2]="vk"; break;
            case 'ok': $links[$i][1]="https://ok.ru/".$links[$i][1]; $links[$i][2]="odnoklassniki"; break;
            case 'fb': $links[$i][1]="https://facebook.com/".$links[$i][1]; $links[$i][2]="facebook"; break;
            case 'github': $links[$i][1]="https://github.com/".$links[$i][1]; $links[$i][2]="github"; break;
            case 'gitlab': $links[$i][1]="https://gitlab.com/".$links[$i][1]; $links[$i][2]="gitlab"; break;
            case 'lgitlab':$links[$i][2]="gitlab"; break;
            case 'twitter': $links[$i][1]="https://twitter.com/".$links[$i][1]; $links[$i][2]="twitter"; break;
            case 'viber': $links[$i][1]=$links[$i][0].":".$links[$i][1]; $links[$i][2]="viber"; break;
            case 'whatsapp': $links[$i][1]=$links[$i][0].":".$links[$i][1]; $links[$i][2]="whatsapp"; break;
            case 'icq': $links[$i][1]=$links[$i][0].":".$links[$i][1]; $links[$i][2]="rocketchat"; break;
            case 'xmpp': $links[$i][1]=$links[$i][0].":".$links[$i][1]; $links[$i][2]="rocketchat"; break;
            default: $links[$i][1]=$links[$i][0].":".$links[$i][1]; $links[$i][2]=""; break;
            }
    }
if (isset($links)) return $links; else return "";
}

public static function DrawButtons($links, $mode){
    $buttons='';
    for ($i=0; isset($links[$i][0]); $i++) {
        if ("image" == $mode) {
            $buttons = $buttons."<li class=\"".$links[$i][0]."\"><a href=\"".$links[$i][1]."\" target=\"_blank\"></a></li>";
        } else {
            $buttons = $buttons."<a href='".$links[$i][1]."' target=\"_blank\"><i class='fab fa-".$links[$i][2]." fa-3x'></i></a>&nbsp;";
        }
    }
        if ("image" == $mode){$buttons ="<div id=\"img-social-icons\"><ul>".$buttons."</ul></div>";}
    return $buttons;
}
}