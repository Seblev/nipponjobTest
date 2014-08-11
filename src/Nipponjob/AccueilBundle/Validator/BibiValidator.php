<?php

namespace Nipponjob\AccueilBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\Request;

class BibiValidator extends ConstraintValidator
{

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validate($value, Constraint $constraint)
    {

        if ((preg_match("#Bibi#", $value) != 0 || $this->request->getPathInfo() != "/ajouter"))
        {
            $this->context->addViolation($constraint->message);
        }
    }
}