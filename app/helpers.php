<?php
function getData($model)
    {
        $model ="\App\Models".$model;
        // return app($model)->where('is_active',1)->orderBy('serialize','asc');
        return app($model)->all();

    }

function imageUpload($file)
{
    $file_name = time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('images/'), $file_name);
    return $file_name;
}
function removeOldImage($file)
{
    unset($file);
}
