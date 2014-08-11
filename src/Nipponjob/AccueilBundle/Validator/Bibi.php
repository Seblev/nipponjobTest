<?php

namespace Nipponjob\AccueilBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Bibi extends Constraint
{

    public $message = 'Pas de Bibi dans le titre.';

    public function validatedBy()
    {
        return 'nipponjob.bibi';
    }
}