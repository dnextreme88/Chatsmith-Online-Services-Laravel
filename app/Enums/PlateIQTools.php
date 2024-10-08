<?php

namespace App\Enums;

enum PlateIQTools: string
{
    case FULL_FORM = 'Full Form';
    case NEEDS_MANAGER_REVIEW = 'Needs Manager Review (NMR)';
    case NEW_DATA_ENTRY = 'New Data Entry (NDE)';
    case PENDING_HEADER = 'Pending Header';
    case STATEMENTS = 'Statements';
    case VERIFICATION = 'Verification';
}
