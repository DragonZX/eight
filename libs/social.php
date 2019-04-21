<?php

class Social
{
public static function GetLinks($string) //Parsing user LDAP string to links
{

    $proto= explode(";", $string);
    for ($i=0; isset($proto[$i]); $i++){$links[$i]=explode(":", $proto[$i]);}
    for ($i=0; isset($links[$i][0]); $i++)
    {
           switch ($links[$i][0]) //rules of parsing
            {
            case 'vk': $links[$i][1]="https://vk.com/".$links[$i][1]; break;
            case 'ok': $links[$i][1]="https://ok.ru/".$links[$i][1]; break;
            case 'github': $links[$i][1]="https://github.com/".$links[$i][1]; break;
            case 'twitter': $links[$i][1]="https://twitter.com/".$links[$i][1]; break;
            default: $links[$i][1]=$links[$i][0].":".$links[$i][1]; break;
            }
    }
if (isset($links)) return $links; else return "";
}
}