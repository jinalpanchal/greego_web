<?php

namespace App\Helpers\Notification;

use Illuminate\Support\Facades\DB;
use App\User;

class PushNotification {

    /**
     * @param int $user_id User-id
     * 
     * @return string
     */
    public static function SendPushNotification($msg) {
        self::PushAndroidNotification($msg);
        self::PushIphoneNotification($msg);
    }
    
    public static function PushAndroidNotificationUser($msg, $device_ids) {
        
        define('API_ACCESS_KEY', 'AAAAtZ6SfW8:APA91bFRp3NuUPIg0lxr0TlJscQgFJXLA15rMb_pL9V1fI1kxqzsvFB31pIHY1SF0tmRezB2kxYQ7GpqJHS4FJBgvy0vahIZg0daGJoEBnNYP7KmxT0oNMPEgrP89k-eFfrILcV1b1Bk');

        // $device_ids = 'd5VO2oR8wio:APA91bFuH6QYOCJs63BpXrFBkkJBEb04hL63RchcDLonD1BshBVp6p1kPW6cf8Y3OEzy_5i5KnMMjsMfE2B7GjtV6VmHwfD_q3GHm6MgC_XwHv7AeiBxYH1OgpQ94XTfXLaLJLF5-T_V';
       
        $device_ids = $device_ids;
        // dd($device_ids);
        $fields = array
            (
            'to' => $device_ids,
            'to' => 'cyN4M2EkOCY:APA91bGKGRhBkNjI9PS4qkYauiq0Fj35wBYlUf7dwkImh_Py4tE2PVKKd3kbs39gQAhVjGg8sIuB2EcsEguc88SvA-US4LGEuVSz8Q9RPz5u6cVGZ0JesksMuAdlkXlY9TzoNMbLzv-o',
            'notification' => $msg
        );
    $headers = array
        (
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
    );
#Send Reponse To FireBase Server	
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
#Echo Result Of FireBase Server
        // dd($result);
    }

    public static function PushIphoneNotification($msg) {
        $device_ids = User::where('is_active', 1)
                ->where('device_id', '<>', '')
                ->where('is_iphone', 1)
                ->pluck('device_id')
                ->toArray();
        
        foreach ($device_ids as $device_id) {
            self::iphoneNotification($token, $msg);
        }
        
    }
    
    public static function PushiphoneNotificationUser($token, $msg){
        $production = false;
        if ($production) {
            $gateway = 'gateway.push.apple.com:2195';
        } else {
            $gateway = 'gateway.sandbox.push.apple.com:2195';
        }

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', storage_path('app/CertificatesDev.pem'));
        stream_context_set_option($ctx, 'ssl', 'passphrase', '1234');
        $fp = stream_socket_client(
                $gateway, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp) {
            die("Failed to connect: $err $errstr");
        }

        stream_set_blocking($fp, 0);
        $result = fwrite($fp, $msg, strlen($msg));
        fclose($fp);
    }

}
