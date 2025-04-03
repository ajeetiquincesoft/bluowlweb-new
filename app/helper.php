<?php

if (!function_exists('upload_image')) {
    function upload_image($data)
    {
        $filename = time() . rand() . "PI." . $data->getClientOriginalExtension();
        $data->storeAs('public/uploads', $filename);
        return  $filename;
    }
}
?>
