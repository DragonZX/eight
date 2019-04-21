<?php


class Social
{
public static function GetLinks($string) //Parsing user LDAP string to links
{

    $proto= explode(";", $string);
    for ($i=0; isset($proto[$i]); $i++){$links[$i]=explode(":", $proto[$i]);}
    for ($i=0; isset($links[$i][1]); $i++)
    {
       if(isset($links))
       {
           switch ($links[$i][1]) //rules of parsing
            {
            case 'vk': $links[$i][2]="https://vk.com/".$links[$i][2]; break;
            case 'ok': $links[$i][2]="https://ok.ru/".$links[$i][2]; break;
            case 'github': $links[$i][2]="https://github.com/".$links[$i][2]; break;
            case 'twitter': $links[$i][2]="https://twitter.com/".$links[$i][2]; break;
            default: $links[$i][2]=$links[$i][1].$links[$i][2]; break;
            }
        }
    }
if (isset($links)) return $links; else return "";
}
}