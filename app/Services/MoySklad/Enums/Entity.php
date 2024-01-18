<?php

namespace App\Services\MoySklad\Enums;

enum Entity: string
{
    case orders = 'customerorder';
    case agent = 'counterparty';
    case organization = 'organization';
    case rate = 'currency';
    case states = 'metadata';
    case owner = 'employee';
    case group = 'group';
}
