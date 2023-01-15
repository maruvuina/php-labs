<?php
/**
 * Синоминайзер, перемешиватель абзацев и предложений
 *
 */
class synonymizer{

    /**
     * Символ разделения параграфов
     *
     * @var string
     */
    private $paragraph_symbol;

    /**
     * Использовать в качестве синонима оригинал слова
     *
     * @var boolean
     */
    private $synonym_original;
    /**
     * Путь к файлу базы
     *
     * @var string
     */
    private $synonym_base_path;

    /**
     * конструктор класса
     *
     */
    public function __construct($parSymb="</p>", $synOriginal=false, $basePath="synbase.dat"){
        $this->paragraph_symbol=$parSymb;
        $this->synonym_original=$synOriginal;
        $this->synonym_base_path=$basePath;
    }

    /**
     * Основная функция класса
     *
     * @param string $text - входной текст для изменения
     * @param boolean $use_synonymizer - использовать синоминайзер?
     * @param boolean $mashup_paragraph - перемешивать параграфы?
     * @param boolean $mashup_sentence - перемешивать предложения в параграфах?
     * @return string - измененный текст
     */
    public function change_text($text, $use_synonymizer=true, $mashup_paragraph=true, $mashup_sentence=true){

        if ($use_synonymizer){
            $text=$this->synonymizer($text);
        }

        return $text;
    }

    /**
     * Функция для замены слов синонимами
     *
     * @param string $text - входной текст для изменения
     * @return string - измененный текст
     */
    private function synonymizer($text){
        $handle = fopen("./".$this->synonym_base_path, "r");
        $contents = ''; $i=0;
        while (!feof($handle)) {
            $buffer = fgets($handle, 4096);
            $marr=explode("=",$buffer);
            $original=$marr***91;0***93;;

            $synarr=explode(",",$marr***91;1***93;);
            if($this->synonym_original)$synarr***91;***93;=$original;
            $syn=$synarr***91;
            rand()%count($synarr)***93;;
            $text=str_replace(" ".$original." "," ".$syn." ",$text);
            $text=str_replace(" ".$original.","," ".$syn.",",$text);
            $text=str_replace(" ".$original."."," ".$syn.".",$text);
//            $text=preg_replace("/(***91;\.\!\?\s***93;)".$original."(***91;\.\!\?\s***93;)/","$1".$syn."$2",$text);
            $i++;
        }
        fclose($handle);
        return $text;
    }

}

?>