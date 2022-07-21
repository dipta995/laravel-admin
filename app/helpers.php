<?php
function getData($model)
    {
        $model ="\App\Models".$model;
        return app($model)->where('is_active',1)->orderBy('serialize','asc');

    }
