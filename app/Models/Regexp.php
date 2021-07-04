<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regexp extends Model
{
    use HasFactory;

    public function getRegexp($request)
    {//generate regexp

        if($request->beforeText == null && $request->textStart == null && $request->textFinish == null && $request->afterText == null) {
            return $regexp = ".+";
        }
        else {
            $beforeText = $this->beforeText($request->beforeText); //перед искомым текстом
            $textStart = $this->textStart($request->textStart); //искомый текст
            $textFinish = $this->textFinish($request->textFinish);  //Этим заканчивается искомый текст
            $afterText = $this->afterText($request->afterText); //после искомого текста

            if ($request->shortestMatch == "on") {
                $textFinish = "?$textFinish";
            }

            if ($request->textWrap == "on") { //allow wrap
                $textStart = "{$textStart}[\w\W]*";
            } else { //no wrap
                $textStart = "{$textStart}.*";
            }
            //сборка и возврат результата
            $regexp = "{$beforeText}{$textStart}{$textFinish}{$afterText}";
            return $regexp;
        }
    }

    public function beforeText($beforeText)
    {//перед искомым текстом
        //разбор строки по кускам и замена символов типа слэша
        $strArray = str_split($beforeText);
        $result = $this->specCharacterReplacer($strArray); //в цикле проходим по массиву символов, ищем спец. символы и заменяем
        return $result = "(?<=$result)";
    }

    public function afterText($afterText)
    {//после искомого текста
        $strArray = str_split($afterText);
        $result = $this->specCharacterReplacer($strArray); //в цикле проходим по массиву символов, ищем спец. символы и заменяем

        return $result = "(?=$result)";
    }

    public function textStart($textStart)
    {//искомый текст
        $strArray = str_split($textStart); //string to array
        $result = $this->specCharacterReplacer($strArray);

        return $result;
    }

    public function textFinish($textFinish)
    {//Этим заканчивается искомый текст
        $strArray = str_split($textFinish);
        $result = $this->specCharacterReplacer($strArray); //в цикле проходим по массиву символов, ищем спец. символы и заменяем

        return $result;
    }

    public function specCharacterReplacer($strArray)
    { //replace special character
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
        $newString = implode($newString);
        return $newString;
    }
}
