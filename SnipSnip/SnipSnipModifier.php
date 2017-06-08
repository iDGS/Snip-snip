<?php

namespace Statamic\Addons\SnipSnip;

use Statamic\Extend\Modifier;

class SnipSnipModifier extends Modifier
{
    public function index($value, $params, $context)
    {
        if (isset($params[1]) && $params[1] != "")
        {
            $ending = $params[1];
        }
        else
        {
            $ending = "&hellip; <a href='{{ url }}' class=' scc-article-summary-content-read-more ' title='Read more about &ldquo;{{ title }}&rdquo;?'>[<span class=' offscreen '>READ </span><span class=' scc-article-summary-content-read-more-text '>MORE</span>]<span class=' offscreen '>About { title }</span></a>";
        }
        $length = $params[0];


        $words = preg_split("/[\n\r\t ]+/", $value, $length + 1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE);
        $output = '';
        
        if (count($words) > $length)
        {
            end($words);
            $last_word = prev($words);

            $output = substr($value, 0, $last_word[1] + strlen($last_word[0])) . $ending;
        }

        #put all opened tags into an array
        preg_match_all("#<([a-z]+)( .*)?(?!/)>#iU", $output, $result);
        $openedtags = $result[1];

        #put all closed tags into an array
        preg_match_all("#</([a-z]+)>#iU", $output, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);

        # all tags are closed
        if (count($closedtags) == $len_opened)
        {
            return $output;
        }
        $openedtags = array_reverse($openedtags);
        # close tags
        for ($i = 0; $i < $len_opened; $i++)
        {
            if (!in_array($openedtags[$i], $closedtags))
            {
                $output .= "</" . $openedtags[$i] . ">";
            }
            else
            {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }

        return $output;
    }
}
