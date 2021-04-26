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
        $textStart = $request->textStart; //искомый текст
        $afterText = $this->afterText($request->afterText); //после искомого текста
        $textFinish = $request->textFinish;  //Этим заканчивается искомый текст

        //сборка и возврат результата (убери пробелы)
        $finish = "$beforeText{$textStart}.*{$textFinish}{$afterText}";
        return $finish;
    }

    public function beforeText($beforeText)
    {
        //разбор строки по кускам и замена символов типа слэша
        //str_split($beforeText);
        return $result = "(?<=$beforeText)";
    }

    public function afterText($afterText)
    {
        return $result = "(?=$afterText)";
    }
}
