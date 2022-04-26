<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regexp extends Model
{
    use HasFactory;

    public function getRegexp($request): string
    {
        //generate regexp
        if ($this->isAnyTextNull($request)) {
            $regexp = ".+";
        } else {
            $beforeText = $this->beforeText($request->beforeText); //перед искомым текстом
            $textStart = $this->textStart($request->textStart); //искомый текст
            $textFinish = $this->textFinish($request->textFinish);  //Этим заканчивается искомый текст
            $afterText = $this->afterText($request->afterText); //после искомого текста

            if ($request->shortestMatch == "true") {
                $textFinish = "?$textFinish";
            }

            if ($request->textWrap == "true") { //allow wrap
                $textStart = "{$textStart}[\w\W]*";
            } else { //no wrap
                $textStart = "{$textStart}.*";
            }
            //сборка и возврат результата
            $regexp = "{$beforeText}{$textStart}{$textFinish}{$afterText}";
        }
        return $regexp;
    }

    public function beforeText($beforeText): string
    {
        $result = '';
        $strArray = str_split($beforeText);
        $result = $this->specCharacterReplacer($strArray);
        return $result = "(?<=$result)";
    }

    public function afterText($afterText): string
    {
        //после искомого текста
        $result = '';
        $strArray = str_split($afterText);
        $result = $this->specCharacterReplacer($strArray);

        return $result = "(?=$result)";
    }

    public function textStart($textStart): string
    {
        //искомый текст
        $result = '';
        $strArray = str_split($textStart);
        $result = $this->specCharacterReplacer($strArray);

        return $result;
    }

    public function textFinish($textFinish): string
    {
        //Этим заканчивается искомый текст
        $result = '';
        $strArray = str_split($textFinish);
        $result = $this->specCharacterReplacer($strArray);

        return $result;
    }

    public function specCharacterReplacer($strArray): string
    {
        //в цикле проходим по массиву символов, ищем спец. символы и заменяем
        foreach ($strArray as $symbol) {
            // экранирование . ^ $ * + ? { } [ ] \ | ( )
            switch ($symbol) {
                case ".":
                    $symbol = "\\.";
                    break;
                case "^":
                    $symbol = "\\^";
                    break;
                case '$':
                    $symbol = "\\$";
                    break;
                case '*':
                    $symbol = "\\*";
                    break;
                case '+':
                    $symbol = "\\+";
                    break;
                case '?':
                    $symbol = "\\?";
                    break;
                case '{':
                    $symbol = "\\{";
                    break;
                case '}':
                    $symbol = "\\}";
                    break;
                case '[':
                    $symbol = "\\[";
                    break;
                case ']':
                    $symbol = "\\]";
                    break;
                case '\\':
                    $symbol = "\\\\";
                    break;
                case '|':
                    $symbol = "\\|";
                    break;
                case '(':
                    $symbol = "\\(";
                    break;
                case ')':
                    $symbol = "\\)";
                    break;
            }
            $newString[] = $symbol;
        }

        if (isset($newString)) {
            $newString = implode($newString);
            return $newString;
        }
    }

    public function isAnyTextNull($request): bool
    {
        if ($request->beforeText == null && $request->textStart == null &&
            $request->textFinish == null && $request->afterText == null) {
            return true;
        } else {
            return false;
        }
    }
}
