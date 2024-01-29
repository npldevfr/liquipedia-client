<?php

namespace Npldevfr\Liquipedia\Meta;

use Npldevfr\Liquipedia\Traits\HasConstants;

final class Operator
{
    use HasConstants;

    public final const EQUAL = '::';

    public final const NOT_EQUAL = '::!';

    public final const GREATER_THAN = '::>';

    public final const LOWER_THAN = '::<';
}
