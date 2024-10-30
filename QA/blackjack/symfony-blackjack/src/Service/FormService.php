<?php

namespace App\Service;

use Symfony\Component\Form\FormInterface;

class FormService
{
    public static function getFormErrors(FormInterface $form): array
    {
        $errors = [];

        foreach ($form->getErrors() as $error) {
            $errors[$form->getName()][] = $error->getMessage();
        }

        foreach ($form as $child) {
            if ($child->isSubmitted() && !$child->isValid()) {
                foreach ($child->getErrors() as $error) {
                    $errors[$child->getName()][] = $error->getMessage();
                }
            }
        }

        return $errors;
    }
}
