<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
use Twilio\Rest\Client;
use Mail;

class MyController extends Controller
{

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($message, $result, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
            'status' => $code
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($message, $errors = [], $code = 404)
    {
        $response = [
            'success' => false,
            'data' => $errors,
            'message' => $message,
            'status' => $code
        ];
        
        /*$response = [
            'success' => false,
            'message' => $message,
           
        ];

        if (!empty($errors)) {
            $response['data'] = $errors;
        }
        $response['status'] = $code;*/

        return response()->json($response, $code);
    }

    public function sendSms($mobile, $msg, $code = 91)
    {
        $client = new Client(env('SID'), env('TWILIO_TOKEN'));
        try {
            $message = $client->messages->create(
                '+' . $code . $mobile,
                [
                    // A Twilio phone number you purchased at twilio.com/console
                    'from' => env('TWILIO_FROM'),
                    // the body of the text message you'd like to send
                    'body' => $msg
                ]
            );
            if ($message) {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }

        return false;
    }

    public function checkPasswordStrength($password)
    {
        $password_length = 8;

        $returnVal = True;

        if (strlen($password) < $password_length) {
            $returnVal = False;
        }

        if (!preg_match("#[0-9]+#", $password)) {
            $returnVal = False;
        }

        if (!preg_match("#[a-z]+#", $password)) {
            $returnVal = False;
        }

        if (!preg_match("#[A-Z]+#", $password)) {
            $returnVal = False;
        }

        if (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $password)) {
            $returnVal = False;
        }

        return $returnVal;
    }

    public function sendEmail($data)
    {
        return true;
        Mail::send('mail', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email']);
            $message->subject('OTP Testing');
            $message->from(env('MAIL_USERNAME'), 'Adventures Club');
        });
        if (Mail::failures()) {
            return false;
        }
        return true;
    }

    public function image_path()
    {
        return public_path() . '/' . 'uploads';
    }

    public function resize_crop_image($source_file, $dst_dir, $quality = 80)
    {
        $imgsize = getimagesize($source_file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];

        //        $max_width = ($width * 30) / 100;
        //        $max_height = ($height * 30) / 100;
        $max_width = 180;
        $max_height = 60;
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

    public function getRandomNumber()
    {
        return mt_rand(1000, 9999);
    }

    public function last_query($qry)
    {
        DB::enableQueryLog();
        $qry;
        $this->prx(DB::getQueryLog());
    }

    public function getExtensionSize($file)
    {
        $type = $file['type'];
        $ext_diff = explode('/', $type);
        return ['ext' => $ext_diff[1], 'size' => $file['type']];
    }

    public function allowed_mime()
    {
        return ['jpeg', 'jpg', 'png'];
    }
}
