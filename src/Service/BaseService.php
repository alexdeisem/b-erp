<?php declare(strict_types=1);


namespace App\Service;


use App\Exception\ValidationException;
use App\Service\Validation\ValidatableInterface;

use Symfony\Component\Validator\Validator\ValidatorInterface;


class BaseService
{
    protected ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param ValidatableInterface $validatable Validatable
     *
     * @return void
     * @throws ValidationException
     */
    protected function validate(ValidatableInterface $validatable): void
    {
        $errors = $this->validator->validate($validatable);

        if (count($errors)) {
            throw ValidationException::create($errors);
        }
    }
}
