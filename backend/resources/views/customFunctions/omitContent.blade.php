@php
$char_limit=2000;
   if(mb_strlen($content)>=$char_limit){
    echo mb_substr($content,0,$char_limit)."………(続く)…";
    }else{
        echo $content;
    }
@endphp  