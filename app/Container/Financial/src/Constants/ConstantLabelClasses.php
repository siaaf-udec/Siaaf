<?php

namespace App\Container\Financial\src\Constants;


use App\Container\Financial\src\Check;
use App\Container\Financial\src\PettyCash;

class ConstantLabelClasses
{

    const SUCCESS_CLASS   = 'success';
    const INFO_CLASS      = 'info';
    const WARNING_CLASS   = 'warning';
    const DANGER_CLASS    = 'danger';
    const DEFAULT_CLASS   = 'default';

    /**
     * Return a bootstrap html class
     *
     * @param $state
     * @return string
     */
    public static function className($state)
    {
        switch ($state) {
            case ConstantStatus::REJECTED :
                return self::WARNING_CLASS;
                break;
            case ConstantStatus::WAITING_PAY :
                return self::WARNING_CLASS;
                break;
            case ConstantStatus::WAITING_MIN_PAY :
                return self::WARNING_CLASS;
                break;
            case ConstantStatus::APPROVED :
                return self::SUCCESS_CLASS;
                break;
            case ConstantStatus::PAID :
                return self::SUCCESS_CLASS;
                break;
            case ConstantStatus::PENDING :
                return self::INFO_CLASS;
                break;
            case ConstantStatus::WAITING_QUOTA :
                return self::INFO_CLASS;
                break;
            case ConstantStatus::CHECKING :
                return self::INFO_CLASS;
                break;
            case ConstantStatus::CANCELED :
                return self::DANGER_CLASS;
                break;
            case Check::UNDELIVERED :
                return self::DANGER_CLASS;
                break;
            case Check::DELIVERED :
                return self::SUCCESS_CLASS;
                break;
            case PettyCash::OUT :
                return self::DANGER_CLASS;
                break;
            case PettyCash::IN :
                return self::SUCCESS_CLASS;
                break;
            default:
                return self::DEFAULT_CLASS;
                break;
        };
    }
}