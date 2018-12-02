<?php

namespace Core;


class HeaderUtils
{
    private function __construct()
    {

    }

    public static function split(string $header, string $separators): array
    {
        $quotedSeparators = preg_quote($separators, '/');

        preg_match_all('
        /
            (?!\s)
                (?:
                    # quoted-string
                    "(?:[^"\\\\"]|\\\\.)*(?:"|\\\\|$)
                |
                    # token
                    [^"'.$quotedSeparators.']+
                )+
            (?<!\s)
        |
            # separator
            \s*
            (?<separators>['.$quotedSeparators.'])
            \s*
        /x', trim($header), $matches, PREG_SET_ORDER);

        return self::groupParts($matches, $separators);

    }

    public static function combine(array $parts): array
    {
        $assoc = array();
        foreach ($parts as $part) {
            $name = strtolower($part[0]);
            $value = $part[1] ?? true;
            $assoc[$name] = $value;
        }

        return $assoc;

    }

    private static function groupParts(array $matches, string $separators): array
    {
        $separator = $separators[0];
        $partSeparators = substr($separators, 1);

        $i = 0;
        $partMatches = array();
        foreach ($matches as $match) {
            if (isset ($match['separator']) && $match['separator'] === $separator) {
                ++$i;
            } else {
                $partMatches[$i][] = $match;
            }
        }

        $parts = array();
        if ($partSeparators) {
            foreach ($partMatches as $matches) {
                $parts[] = self::groupParts($matches, $partSeparators);
            }
        } else {
            foreach ($partMatches as $matches) {
                $parts[] = self::unquote($matches[0][0]);
            }
        }

        return $parts;
    }

    public static function unquote(string $s): string
    {
        return preg_replace('/\\\\(.)|"/', '$1', $s);
    }

}
