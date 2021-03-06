<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class LengthValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Length) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\Length');
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $stringValue = (string) $value;

        if (function_exists('grapheme_strlen') && 'UTF-8' === $constraint->charset) {
            $length = grapheme_strlen($stringValue);
        } elseif (function_exists('mb_strlen')) {
            $length = mb_strlen($stringValue, $constraint->charset);
        } else {
            $length = strlen($stringValue);
        }

        if ($constraint->min == $constraint->max && $length != $constraint->min) {
            $this->context->buildViolation($constraint->exactMessage)
                ->setParameter('{{ value }}', $this->formatValue($stringValue))
                ->setParameter('{{ limit }}', $constraint->min)
                ->setInvalidValue($value)
                ->setPlural((int) $constraint->min)
                ->addViolation();

            return;
        }

        if (null !== $constraint->max && $length > $constraint->max) {
            $this->context->buildViolation($constraint->maxMessage)
                ->setParameter('{{ value }}', $this->formatValue($stringValue))
                ->setParameter('{{ limit }}', $constraint->max)
                ->setInvalidValue($value)
                ->setPlural((int) $constraint->max)
                ->addViolation();

            return;
        }

        if (null !== $constraint->min && $length < $constraint->min) {
            $this->context->buildViolation($constraint->minMessage)
                ->setParameter('{{ value }}', $this->formatValue($stringValue))
                ->setParameter('{{ limit }}', $constraint->min)
                ->setInvalidValue($value)
                ->setPlural((int) $constraint->min)
                ->addViolation();
        }
    }
}
