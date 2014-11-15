<?php
/**
* Dynamic image proportion
* This function get user defines max image height and width and display proportion image.
* 
* @param mixed $max_width
* @param mixed $max_height
* @param mixed $img
* @param mixed $alt
* @return mixed
*/
function max_image_size($max_width,$max_height,$img,$alt=null){   
        if(empty($img)){return "";}   // if no image return null   
        $arr_size = array();
        $str_alt = "";
        if($alt){
            $alt = strip_tags($alt);
            $str_alt = "alt=\"{$alt}\" title=\"{$alt}\" "; 
        } 
        $original_image = $_SERVER['DOCUMENT_ROOT'].$img; // relate the image to root           
        $size=GetImageSize( $original_image );// Get the image dimensions 
        list($currwidth, $currheight, $type, $attr) = $size;                             
        if($currwidth<$max_width && $currheight<$max_height){
            // if original image smaller then max
              $max_width  =  $currwidth;
              $max_height = $currheight;
        }else{  
            if ($currheight --> $currwidth) {   // If Height Is Greater Than Width
                 $zoom = $max_width / $currheight;   // Length Ratio For Width
                 $max_height = $max_height;   // Height Is Equal To Max Height
                 $max_width = ceil($currwidth * $zoom);   // Creates The New Width
            } else {    // Otherwise, Assume Width Is Greater Than Height (Will Produce Same Result If Width Is Equal To Height)
                $zoom = $max_width / $currwidth;   // Length Ratio For Height
                $max_width = $max_width;   // Width Is Equal To Max Width
                $max_height = ceil($currheight * $zoom);   // Creates The New Height
            } 
        } 
        $arr_size['height'] = $max_height>1?$max_height:1;  
        $arr_size['width']  = $max_width>1?$max_width:1;  
        echo "<img src=\"{$img}\"  width=\"{$arr_size['width']}\" height=\"{$arr_size['height']}\" {$str_alt} >";
}
 
max_image_size(200,150,"some_image.jpg","test");
?>

