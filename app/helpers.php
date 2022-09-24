<?php

function image_path()
{
    return str_replace('n2p/public/', 'public_html', public_path() . '/uploads');
}

function testfun()
{
    die('Helpers are working fine now.');
}

function resize_crop_image($source_file, $dst_dir, $quality = 80)
{
    $imgsize = getimagesize($source_file);
    $width = $imgsize[0];
    $height = $imgsize[1];
    $mime = $imgsize['mime'];

    $max_width = ($width * 30) / 100;
    $max_height = ($height * 30) / 100;
    switch ($mime) {
        case 'image/gif':
            $image_create = "imagecreatefromgif";
            $image = "imagegif";
            break;

        case 'image/png':
            $image_create = "imagecreatefrompng";
            $image = "imagepng";
            $quality = 7;
            break;

        case 'image/jpeg':
            $image_create = "imagecreatefromjpeg";
            $image = "imagejpeg";
            $quality = 80;
            break;

        default:
            return false;
            break;
    }

    $dst_img = imagecreatetruecolor($max_width, $max_height);
    $src_img = $image_create($source_file);

    $width_new = $height * $max_width / $max_height;
    $height_new = $width * $max_height / $max_width;
    //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
    if ($width_new > $width) {
        //cut point by height
        $h_point = (($height - $height_new) / 2);
        //copy image
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    } else {
        //cut point by width
        $w_point = (($width - $width_new) / 2);
        imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    }
    //    imagejpeg($dst_img);
    $image($dst_img, $dst_dir, $quality);

    if ($dst_img)
        imagedestroy($dst_img);
    if ($src_img)
        imagedestroy($src_img);
}

function getOldAge($dob)
{
    $date1 = date_create($dob);
    $date2 = date_create(date('Y-m-d'));
    $diff = date_diff($date1, $date2);
    if ($diff->y > 1) {
        return $diff->y . ' years';
    } else {
        return $diff->y . ' year';
    }
}

function pr($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function prx($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die();
}
