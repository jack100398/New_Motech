<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    protected $fillable = [
        'name',
        'type',
        'resolution',
        'rated_thrust',
        'acceleration_thrust',
        'rated_current',
        'acceleration_current',
        'max_acceleration',
        'max_speed',
        'accuracy',
        'voltage',
        'ambient_temperature',
        'environment_humidity',
        'storage_temperature',
        'remark',
        'Siemens',
        'ohm',
        'force_constant',
        'kgf',
        'heat_resistance',
        'picture_one',
        'picture_two',
        'picture_three',
        'picture_four',
        'pdf',
        'en_pdf',
        'en_pdf_name',
        'pdf_name',
        'linear_ruler',
        'travel',
        'horizontal_load',
        'vertical_load'
    ];

    protected $cast = [
        'name' => 'string',
        'type' => 'string',
        'resolution' => 'float',
        'rated_thrust' => 'float',
        'acceleration_thrust' => 'float',
        'rated_current' => 'float',
        'acceleration_current' => 'float',
        'max_acceleration' => 'float',
        'max_speed' => 'float',
        'accuracy' => 'float',
        'voltage' => 'float',
        'ambient_temperature' => 'float',
        'environment_humidity' => 'float',
        'storage_temperature' => 'float',
        'remark' => 'string',
        'Siemens' => 'float',
        'ohm' => 'float',
        'force_constant' => 'float',
        'kgf' => 'float',
        'heat_resistance' => 'float',
        'picture_one' => 'string',
        'picture_two' => 'string',
        'picture_three' => 'string',
        'picture_four' => 'string',
        'pdf' => 'string',
        'en_pdf' => 'string',
        'en_pdf_name' => 'string',
        'pdf_name' => 'string',
        'linear_ruler' => 'integer',
        'travel' => 'integer',
        'horizontal_load' => 'integer',
        'vertical_load'  => 'integer'
    ];
}
