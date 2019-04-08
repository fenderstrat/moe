<?php declare(strict_types=1);

namespace Services\Translation;

class Translation
{
    public function isEnabled(): bool
    {
        $value = config('app.enable_translation');

        if (! is_bool($value)) {
            throw new \UnexpectedValueException('$value must be of the type boolean, '.gettype($value).' returned');
        }

        return $value;
    }

    private function __setSessionLocale(string $locale): void
    {
        session()->put(['active_locale' => $locale]);
    }

    private function __getSessionLocale(): ?string
    {
        return session()->get('active_locale');
    }

    public function getDefaultLocale(): string
    {
        return \App::getLocale();
    }

    public function setActiveLocale(string $locale): bool
    {
        $this->__setSessionLocale($locale);
        $value = $this->__getSessionLocale();
        if ($value === $locale) {
            return true;
        }
        return false;
    }

    public function getActiveLocale(): string
    {
        $value = $this->__getSessionLocale();
        if (! is_null($value)) {
            return $value;
        }
        return $this->getDefaultLocale();
    }

    public function getSupportedLocales(): array
    {
        return config('app.translation_languages');
    }

    public function getTotalSupportedLocale(): int
    {
        return count(config('app.translation_languages'));
    }

    public function getLocaleIds(): array
    {
        return array_keys(Translation::getSupportedLocales());
    }

    public function getLocaleNames(): array
    {
        return array_value(Translation::getSupportedLocales());
    }
}