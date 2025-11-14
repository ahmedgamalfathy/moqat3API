<?php
namespace App\Enums\Media;

enum MediaType: int{

case PHOTO = 0;
case VIDEO = 1;

public static function values(): array
{
    return array_column(self::cases(), 'value');
}
}
