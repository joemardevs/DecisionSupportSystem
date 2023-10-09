<?php

namespace App\Enums;


enum ResearchStatusesEnum: int
{
    case ON_GOING = 1;
    case COMPLETED = 2;
    case PRESENTED = 3;
    case PUBLISHED = 4;
    case COPYRIGHTED = 5;
    case ARCHIEVED = 6;
}
