<?php

declare(strict_types=1);

namespace Project\Http\Request;

class CreateLinkValidator
{
    // ########################################

    public function validateRequestData(array $requestData): \Project\Http\Request\CreateLinkValidator\Result
    {
        $isValid       = true;
        $errorMessages = [];

        if (!$this->isTargetLinkValid($requestData)) {
            $isValid = false;

            $errorMessages[] = 'Target link is not valid.';
        }

        if (!$this->isExpirationDateValid($requestData)) {
            $isValid = false;

            $errorMessages[] = 'Expiration date is not valid.';
        }

        return new \Project\Http\Request\CreateLinkValidator\Result($isValid, $errorMessages);
    }

    // ########################################

    private function isTargetLinkValid(array $requestData): bool
    {
        if (!isset($requestData['target_link'])) {
            return false;
        }

        if (empty($requestData['target_link'])) {
            return false;
        }

        return true;
    }

    private function isExpirationDateValid(array $requestData): bool
    {
        if (!isset($requestData['expiration_date'])) {
            return false;
        }

        if (empty($requestData['expiration_date'])) {
            return false;
        }

        $expirationDate = new \DateTime($requestData['expiration_date']);
        if ($expirationDate->getTimestamp() < (new \DateTime())->getTimestamp()) {
            return false;
        }

        return true;
    }

    // ########################################
}
