<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regexp extends Model
{
    use HasFactory;

    public function symbolReplacer($request)
    {

        $beforeText = $this->beforeText($request->beforeText); //перед искомым текстом
        $textStart = $this->textStart($request->textStart); //искомый текст
        $textFinish = $this->textFinish($request->textFinish);  //Этим заканчивается искомый текст
        $afterText = $this->afterText($request->afterText); //после искомого текста



        if($request->shortMatch == "checked") {
            $textFinish = "?$textFinish";
        }
        //сборка и возврат результата
        $finish = "{$beforeText}{$textStart}{$textFinish}{$afterText}";
        return $finish;
    }

    public function beforeText($beforeText)
    {//перед искомым текстом
        //разбор строки по кускам и замена символов типа слэша
        $strArray = str_split($beforeText);
        //в цикле проходим по массиву символов, ищем спец. символы и заменяем их
        foreach ($strArray as $symbol) {
            $newString[] = $this->specReplacer($symbol);

        }
        $newString = implode($newString);

        return $result = "(?<=$newString)";
    }

    public function afterText($afterText)
    {//после искомого текста
        $strArray = str_split($afterText);
        //в цикле проходим по массиву символов, ищем спец. символы и заменяем их
        foreach ($strArray as $symbol) {
            $newString[] = $this->specReplacer($symbol);
        }
        $newString = implode($newString);

    return $result = "(?=$newString)";
    }

    public function textStart($textStart)
    {//искомый текст
        $strArray = str_split($textStart); //string to array

        foreach ($strArray as $symbol) {
            $newString[] = $this->specReplacer($symbol); //ищем спец. символы и заменяем их
        }
        $newString = implode($newString);

        return $result = "$newString.*";
    }

    public function textFinish($textFinish)
    {//Этим заканчивается искомый текст
        $strArray = str_split($textFinish);
        //в цикле проходим по массиву символов, ищем спец. символы и заменяем их
        foreach ($strArray as $symbol) {
            $newString[] = $this->specReplacer($symbol);

        }
        $newString = implode($newString);
        return $result = "$newString";
    }


    public function specReplacer($symbol)
    {
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
        return $symbol;
    }
}
