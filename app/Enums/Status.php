<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Status extends Enum
{
    const UnApplied = 0;
    const Registering = 1;
    const Deleting = 2;

    public static function getStatus($value): string
    {
        switch ($value){
            case self::UnApplied:
                return '未申請';
                brake;
            case self::Registering:
                return '登録申請中';
                brake;
            case self::Deleting:
                return '削除申請中';
                brake;
            default:
                return self::getKey($value);
        }
    }
}
