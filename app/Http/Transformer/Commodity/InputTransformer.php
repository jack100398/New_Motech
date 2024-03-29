<?php

namespace App\Http\Transformer\Commodity;

use App\Helpers\UrlHelper;
use App\Http\Transformer\Transformer;

class InputTransformer extends Transformer
{
    public function transform($model)
    {
        return [
            'id' => $model['id'],
            'name' => $model['name'],
            'type' => $model['type'],
            'resolution' => $model['resolution'],
            'rated_thrust' => $model['rated_thrust'],
            'acceleration_thrust' => $model['acceleration_thrust'],
            'rated_current' => $model['rated_current'],
            'acceleration_current' => $model['acceleration_current'],
            'max_acceleration' => $model['max_acceleration'],
            'max_speed' => $model['max_speed'],
            'accuracy' => $model['accuracy'],
            'voltage' => $model['voltage'],
            'ambient_temperature' => $model['ambient_temperature'],
            'environment_humidity' => $model['environment_humidity'],
            'storage_temperature' => $model['storage_temperature'],
            'remark' => $model['remark'],
            'Siemens' => $model['Siemens'],
            'ohm' => $model['ohm'],
            'force_constant' => $model['force_constant'],
            'kgf' => $model['kgf'],
            'heat_resistance' => $model['heat_resistance'],
            'picture_one' =>  UrlHelper::formatInputUrl($model['picture_one']),
            'picture_two' =>  UrlHelper::formatInputUrl($model['picture_two']),
            'picture_three' => UrlHelper::formatInputUrl($model['picture_three']),
            'picture_four' => UrlHelper::formatInputUrl($model['picture_four']),
            'pdf' => UrlHelper::formatInputUrl($model['pdf']),
            'en_pdf' => UrlHelper::formatInputUrl($model['en_pdf']),
            'en_pdf_name' => $model['en_pdf_name'],
            'pdf_name' => $model['pdf_name'],
            'linear_ruler' => $model['linear_ruler'],
            'travel' => $model['travel'],
            'horizontal_load' => $model['horizontal_load'],
            'vertical_load'  => $model['vertical_load'],
        ];
    }
}
