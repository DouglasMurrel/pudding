<?php

namespace App\Security\CSRF;

use Symfony\Component\Security\Csrf\SameOriginCsrfTokenManager;

class MyTokenManager extends SameOriginCsrfTokenManager
{
    public function isTokenValid(CsrfToken $token): bool
    {
        if (!isset($this->tokenIds[$token->getId()]) && $this->fallbackCsrfTokenManager) {
            return $this->fallbackCsrfTokenManager->isTokenValid($token);
        }

        if (!$request = $this->requestStack->getCurrentRequest()) {
            $this->logger?->error('CSRF validation failed: No request found.');

            return false;
        }

        if (\strlen($token->getValue()) < self::TOKEN_MIN_LENGTH && $token->getValue() !== $this->cookieName) {
            $this->logger?->warning('Invalid double-submit CSRF token.');

            return false;
        }

        if (false === $isValidOrigin = $this->myIsValidOrigin($request)) {
            $this->logger?->warning('CSRF validation failed: origin info doesn\'t match.');

            return false;
        }

        if (false === $isValidDoubleSubmit = $this->isValidDoubleSubmit($request, $token->getValue())) {
            return false;
        }

        if (null === $isValidOrigin && null === $isValidDoubleSubmit) {
            $this->logger?->warning('CSRF validation failed: double-submit and origin info not found.');

            return false;
        }

        // Opportunistically lookup at the session for a previous CSRF validation strategy
        $session = $request->hasPreviousSession() ? $request->getSession() : null;
        $usageIndexValue = $session instanceof Session ? $usageIndexReference = &$session->getUsageIndex() : 0;
        $usageIndexReference = \PHP_INT_MIN;
        $previousCsrfProtection = (int) $session?->get($this->cookieName);
        $usageIndexReference = $usageIndexValue;
        $shift = $request->isMethodSafe() ? 8 : 0;

        if ($previousCsrfProtection) {
            if (!$isValidOrigin && (1 & ($previousCsrfProtection >> $shift))) {
                $this->logger?->warning('CSRF validation failed: origin info was used in a previous request but is now missing.');

                return false;
            }

            if (!$isValidDoubleSubmit && (2 & ($previousCsrfProtection >> $shift))) {
                $this->logger?->warning('CSRF validation failed: double-submit info was used in a previous request but is now missing.');

                return false;
            }
        }

        if ($isValidOrigin && $isValidDoubleSubmit) {
            $csrfProtection = 3;
            $this->logger?->debug('CSRF validation accepted using both origin and double-submit info.');
        } elseif ($isValidOrigin) {
            $csrfProtection = 1;
            $this->logger?->debug('CSRF validation accepted using origin info.');
        } else {
            $csrfProtection = 2;
            $this->logger?->debug('CSRF validation accepted using double-submit info.');
        }

        if (1 & $csrfProtection) {
            // Persist valid origin for both safe and non-safe requests
            $previousCsrfProtection |= 1 & (1 << 8);
        }

        $request->attributes->set($this->cookieName, ($csrfProtection << $shift) | $previousCsrfProtection);

        return true;
    }
    
    /**
     * @return bool|null Whether the origin is valid, null if missing
     */
    private function myIsValidOrigin(Request $request): ?bool
    {
        $source = $request->headers->get('Origin') ?? $request->headers->get('Referer') ?? 'null';

        return 'null' === $source ? null : str_starts_with(str_replace('https://','http://',$source).'/', $request->getSchemeAndHttpHost().'/');
    }
}
