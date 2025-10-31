<?php

/***************************************************************************
 * SysFramework - PHP Framework                                            *
 * ======================================================================= *
 *                                                                          *
 * PHP Framework                                                            *
 * (c) 2025 Marco Costa  |  sysframework@syspanel.com.br                    *
 * Website: https://sysframework.syspanel.com.br                            *
 *                                                                          *
 * Licensed under the MIT License                                           *
 *                                                                          *
 * Permission is hereby granted, free of charge, to any person obtaining    *
 * a copy of this software and associated documentation files (the          *
 * "Software"), to deal in the Software without restriction, including      *
 * without limitation the rights to use, copy, modify, merge, publish,      *
 * distribute, sublicense, and/or sell copies of the Software, and to       *
 * permit persons to whom the Software is furnished to do so, subject to    *
 * the following conditions:                                                *
 *                                                                          *
 * The above copyright notice and this permission notice shall be included  *
 * in all copies or substantial portions of the Software.                   *
 *                                                                          *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS  *
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF               *
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.   *
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY     *
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,     *
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE        *
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.                   *
 ***************************************************************************/

namespace Core;

/**
 * SysLocale
 * --------------------------------------------------------------------------
 * This class provides multilingual support for SysFramework applications.
 * It loads localized message files from /app/locales, manages the current
 * language through session storage, and provides an easy translation method.
 *
 * The Locale system is designed to be simple, lightweight, and compatible
 * with PHP native session management.
 *
 * Usage example:
 *   SysLocale::init();
 *   echo SysLocale::t('welcome');
 *   SysLocale::setLocale('en_US');
 */
class SysLocale
{
    /** 
     * @var string Default language code used when no locale is defined. 
     * Example: 'pt_BR'
     */
    protected static $default = 'pt_BR';

    /** 
     * @var string Base path for locale directories containing translation files.
     * Each subfolder (pt_BR, en_US, etc.) must include a 'messages.php' file.
     */
    protected static $basePath = __DIR__ . '/../locales/';

    /** 
     * @var array Loaded translation messages.
     * Keys are translation identifiers, and values are localized strings.
     */
    protected static $messages = [];

    /**
     * Initializes the locale system.
     * ----------------------------------------------------------------------
     * This method starts the session if not already started, retrieves the
     * current locale from the session (or falls back to the default locale),
     * and loads the corresponding message file.
     *
     * @return void
     */
    public static function init(): void
    {
        // Ensure a session is active (required to store locale state)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Retrieve the locale from session, or use the default one
        $locale = $_SESSION['locale'] ?? self::$default;

        // Load the corresponding locale file
        self::load($locale);
    }

    /**
     * Loads a specific locale file.
     * ----------------------------------------------------------------------
     * This method attempts to load the translation file for the specified
     * locale. If the file does not exist, it falls back to the default locale.
     *
     * @param string $locale The locale identifier (e.g., 'en_US', 'pt_BR').
     * @return void
     */
    public static function load(string $locale): void
    {
        $file = self::$basePath . $locale . '/messages.php';

        if (file_exists($file)) {
            // Load translations for the selected locale
            self::$messages = include $file;
            $_SESSION['locale'] = $locale;
        } else {
            // Fallback to default locale if file not found
            self::$messages = include self::$basePath . self::$default . '/messages.php';
            $_SESSION['locale'] = self::$default;
        }
    }

    /**
     * Translates a given message key.
     * ----------------------------------------------------------------------
     * This method retrieves the localized text for a given translation key.
     * If the key is missing from the current locale file, the key itself is
     * returned as a fallback to avoid breaking the UI.
     *
     * @param string $key The translation key (identifier).
     * @return string The localized string, or the key if not found.
     */
    public static function t(string $key): string
    {
        return self::$messages[$key] ?? $key;
    }

    /**
     * Gets the current locale in use.
     * ----------------------------------------------------------------------
     * This function simply returns the current session locale, or the default
     * one if no locale has been defined yet.
     *
     * @return string The current locale code.
     */
    public static function getLocale(): string
    {
        return $_SESSION['locale'] ?? self::$default;
    }

    /**
     * Manually sets the current locale.
     * ----------------------------------------------------------------------
     * This method can be used to manually switch the application language,
     * typically triggered by a user action (such as clicking a flag icon).
     *
     * It automatically loads the corresponding translation file and updates
     * the session variable.
     *
     * @param string $locale The new locale code (e.g., 'es_ES', 'fr_FR').
     * @return void
     */
    public static function setLocale(string $locale): void
    {
        self::load($locale);
    }
}

