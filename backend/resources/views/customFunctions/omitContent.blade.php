@php
$char_limit=300;
   if(mb_strlen($content)>=$char_limit){
    echo mb_substr($content,0,$char_limit)."……";
    }else{
        echo $content;
    }
@endphp  